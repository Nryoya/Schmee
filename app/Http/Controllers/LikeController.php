<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * like処理
     *
     * @param Request $request
     * @return json $like_array
     */
    public function like(Request $request) {
        
        // いいね済みかどうか判断
        if(!Like::where('users_id', Auth::user()->id)->where('articles_id', $request->articles_id)->first()) {
            Like::create([
                'users_id' => Auth::user()->id,
                'articles_id' => $request->articles_id,
            ]);
        } else {
            Like::where('users_id', Auth::user()->id)
                ->where('articles_id', $request->articles_id)
                ->delete();
        }

        // いいね数の取得
        $like_count = Article::withCount('likes')
            ->find($request->articles_id)
            ->likes_count;

        $like_array = [
            'like_count' => $like_count,
        ];

        return json_encode($like_array);
    }

    public function show(LIke $like, int $article_id): \Illuminate\View\View 
    {
        return view('like.list', ['like_users' => $like->fetchUserWhoLike($article_id)]);
    }
}
