<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommentController;
use App\Models\Like;
use App\Models\Comment;
use App\Http\Requests\articleRequest;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Mail\PostMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{
    /**
     * articleRepositoryInterface
     *
     * @var object
     */
    private $article_repository;

    /**
     * userRepositoryInterface
     *
     * @var object
     */
    private $user_repository;

    /**
     * コンストラクト
     *
     * @param ArticleRepositoryInterface $article_repository
     * @param UserRepositoryInterface $user_repository
     */
    public function __construct(ArticleRepositoryInterface $article_repository, UserRepositoryInterface $user_repository)
    {
        $this->article_repository = $article_repository;
        $this->user_repository = $user_repository;
    }

    // admin
    /**
     *  学校通信一覧
     * 
     * @param integer $id 学校ID
     * @return view adminByArticlesを返す
     */
    public function bySchoolArticles($id) {
        $articles = Article::where('articles.Schools_id', $id)
        ->join('teachers_detail', 'articles.users_id', '=', 'teachers_detail.users_id')
        ->join('users', 'articles.users_id', '=', 'users.id')
        ->select('articles.*', 'teachers_detail.imgPath', 'users.name')
        ->orderby('articles.created_at', 'desc')
        ->get();

        return view('admin.adminByArticles', compact('articles'));
    }


    // 保護者、関係者
    /**
     * 保護者、関係者の学校通信一覧
     *
     * @return view articlesを返す
     */
    public function articleAll() {
        $like_flg = false;
        if(Auth::user()->id == 0) {
            $articles = Article::where('articles.Schools_id', Auth::user()->schools_id)
                ->where('grade', session('grade') or 0)
                ->where('class', session('class') or 0)
                ->join('teachers_detail', 'articles.users_id', '=', 'teachers_detail.users_id')
                ->join('users', 'articles.users_id', '=', 'users.id')
                ->join('comments', 'articles.id', '=', 'comments.articles_id')
                ->select('articles.*', 'teachers_detail.imgPath', 'users.name')
                ->selectRaw('COUNT(comments.articles_id) as commentCount')
                ->orderby('articles.created_at', 'desc')
                ->groupBy('comments.articles_id', 'teachers_detail.imgPath', 'users.name')
                ->get();
        } else {
            $articles = Article::where('articles.Schools_id', Auth::user()->schools_id)
                ->join('teachers_detail', 'articles.users_id', '=', 'teachers_detail.users_id')
                ->join('users', 'articles.users_id', '=', 'users.id')
                ->join('comments', 'articles.id', '=', 'comments.articles_id')
                ->select('articles.*', 'teachers_detail.imgPath', 'users.name')
                ->selectRaw('COUNT(comments.articles_id) as commentCount')
                ->orderby('articles.created_at', 'desc')
                ->groupBy('comments.articles_id', 'teachers_detail.imgPath', 'users.name')
                ->get();
        }

        return view('articles', compact('articles'));
    }

    public function userArticleDetail($id, CommentController $comment) {
        $detail = Article::where('articles.id', $id)
        ->join('teachers_detail', 'articles.users_id', '=', 'teachers_detail.users_id')
        ->join('users', 'articles.users_id', '=', 'users.id')
        ->select('articles.*', 'teachers_detail.imgPath', 'users.name')
        ->orderby('articles.created_at', 'desc')
        ->get();

        $comments = $comment->getComments($id);
        $comment_count = $comment->getCommentsCount($id);

        return view('articleDetail', compact('detail', 'comments', 'comment_count'));
    }

    /**
     * 学校通信投稿
     *
     * @param articleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function post(articleRequest $request): \Illuminate\Http\RedirectResponse
    {
        // imgの取得
        $img = $request->file('img');

        //send_allにcheckがついていた時
        if($request->send_all == 'on')
        {
            $request['grade'] = 0;
            $request['class'] = 0;
        }
        
        if(isset($img))
        {   
            //storageに登録しパスを代入
            $path = $img->store('img', 'public');
            $request['path'] = $path;
            $post_article = $this->article_repository->postCreateIsImg($request);
        }

        // //画像がない時
        $post_article = $this->article_repository->postCreate($request);

        //send_mailにcheckがついていた時
        if($request->send_email == 'on')
        {
            //〇年〇組の保護者にメールを送る処理
            if($request->grade != 0 && $request->class != 0)
            {
                $to_email_users = $this->user_repository->getFromSchoolGradeClassRole(['school_id' => Auth::user()->schools_id, 'grade' => $request->grade, 'class' => $request->class, 'role' => 0]);
                for($i = 0; $i < count($to_email_users); $i++)
                {
                    Mail::to($to_email_users[$i])->send(new PostMail($to_email_users[$i], $post_article));
                }
            }

            //〇学年の保護者にメールを送る処理
            if($request->grade != 0)
            {
                $to_email_users = $this->user_repository->getFromSchoolGradeRole(['school_id' => Auth::user()->schools_id, 'grade' => $request->grade, 'role' => 0]);
                for($i = 0; $i < count($to_email_users); $i++)
                {
                    Mail::to($to_email_users[$i])->send(new PostMail($to_email_users[$i], $post_article));
                }
            }

            //学校の保護者全てに送る処理
            if($request->send_all == 'on')
            {
                $to_email_users = $this->user_repository->getFromSchoolRole(['school_id' => Auth::user()->schools_id, 'role' => 0]);
                for($i = 0; $i < count($to_email_users); $i++)
                {
                    Mail::to($to_email_users[$i])->send(new PostMail($to_email_users[$i], $post_article));
                }
            }
        }

        return redirect(route('articles'));
    }

    /**
     * articlesテーブルから同じ学校のデータを取得
     *
     * @return void
     */
    public function getAllArticle(Article $article) {
        if(Auth::user()->role == 0) {
            $articles = $article->modelShowArticle(['school_id' => Auth::user()->schools_id, 'grade' => Auth::user()->users_detail->grade, 'class' => Auth::user()->users_detail->class]);
        } else {
            $articles = $article->modelShowArticleAll(Auth::user()->schools_id);
        }
        return view('articles', compact('articles'));
    }

    /**
     * articlesテーブルから$idと一致するデータを取得
     *
     * @param integer $id
     * @return view
     */
    public function getFindArticle($id) {
        $articles = Article::find($id);
        $comments = Comment::where('articles_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('articleDetail', compact('articles', 'comments'));
    }

    /**
     * 記事の論理削除
     *
     * @param integer $id
     * @return view
     */
    public function updateDelFg($id, Article $article) {
        $article->logicalDelete($id);
        return redirect('articles');
    }

    /**
     * 記事の検索機能
     *
     * @param Request $request
     * @param Article $article
     * @return view
     */
    public function controllerSearchArticle(Request $request, Article $article) {
        $keyword = $request->input('search');
        if(Auth::user()->role == 0) {
            $articles = $article->modelSearchArticle(['school_id' => Auth::user()->schools_id, 'grade' => Auth::user()->users_detail->grade, 'class' => Auth::user()->users_detail->class], $keyword);
        } else {
            $articles = $article->modelSearchArticleSchool(['school_id' => Auth::user()->schools_id, 'grade' => Auth::user()->teachers_detail->grade, 'class' => Auth::user()->teachers_detail->class], $keyword);
        }
        return view('search_result_article', ['articles' => $articles]);
    }

    /**
     * admin
     */
    /**
     * 記事の検索機能
     *
     * @param Request $request
     * @param Article $article
     * @return void
     */
    public function controllerAdminSearchArticle(Request $request, Article $article) {
        $keyword = $request->input('search');
        $school_id = $request->school_id;
        $articles = $article->modelAdminSearchArticle($school_id, $keyword);

        return view('admin.search_result_article', ['articles' => $articles]);
    }

    /**
     * 学校通信詳細
     *
     * @param integer $id 学校通信ID
     * @return view adminArticleDetailを返す
     */
    public function adminArticleDetail($article_id, Article $article) {
        $article_detail = $article->modelShowArticleDetail($article_id);

        return view('admin.adminArticleDetail', ['article' => $article_detail]);
    }
}
