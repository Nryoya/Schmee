<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommentController;
use App\Models\Like;
use App\Models\Comment;

class ArticleController extends Controller
{
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

    /**
     * 学校通信詳細
     *
     * @param integer $id 学校通信ID
     * @return view adminArticleDetailを返す
     */
    public function adminArticleDetail($id) {
        $detail = Article::where('articles.id', $id)
        ->join('teachers_detail', 'articles.users_id', '=', 'teachers_detail.users_id')
        ->join('users', 'articles.users_id', '=', 'users.id')
        ->select('articles.*', 'teachers_detail.imgPath', 'users.name')
        ->orderby('articles.created_at', 'desc')
        ->get();

        

        return view('admin.adminArticleDetail', compact('detail'));
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

                // どの記事にいいねしているかいいねテーブルから取ってきてviewで学校通信IDと比較？？
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
     * @param Request $request
     * @return redirect articlesを返す
     */
    public function post(Request $request) {
        
        // バリデーション
        $credentials = $request->validate([
            'ttl' => ['required'],
            'body' => ['required', 'max:255'],
        ]);

        // imgの取得
        $img = $request->file('imgPath');

        // imgに値が入っていれば
        if(isset($img)) {
            $path = $img->store('img', 'public');
            Article::create([
                'title' => $credentials['ttl'],
                'body' => $credentials['body'],
                'articleImg' => $path, 
                'schools_id' => Auth::user()->schools_id,
                'users_id' => Auth::user()->id,
                'grade' => $request->grade,
                'class' => $request->class,
            ]);
        } else {
            Article::create([
                'title' => $credentials['ttl'],
                'body' => $credentials['body'],
                'schools_id' => Auth::user()->schools_id,
                'users_id' => Auth::user()->id,
                'grade' => $request->grade,
                'class' => $request->class,
            ]);
        }

        return redirect('articles');
    }

    /**
     * articlesテーブルから同じ学校のデータを取得
     *
     * @return void
     */
    public function getAllArticle() {
        $articles = Article::where('schools_id', Auth::user()->schools_id)
            ->orderBy('created_at', 'desc')
            ->get();
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
}
