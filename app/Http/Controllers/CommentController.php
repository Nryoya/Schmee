<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Jobs\Jobs;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CommentController extends Controller
{

    /**
     * 非同期コメント投稿
     *
     * @param Request $request
     * @return json $result
     */
    public function comment(Request $request) {
        // バリデーション
        $credentials = $request->validate([
            'body' => ['required', 'max:255', ],
        ]);

        // テーブルに挿入
        Comment::create([
            'articles_id' => $request->articles_id,
            'users_id' => Auth::user()->id,
            'body' => $credentials['body'],
            'del_fg' => 0,
            'created_at' => Carbon::now()
        ]);

        $teacher = Comment::where('comments.articles_id', $request->articles_id)
        ->where('comments.users_id', Auth::user()->id)
        ->where('comments.body', $credentials['body'])
        ->join('users', 'comments.users_id', '=', 'users.id')
        ->join('teachers_detail', 'comments.users_id', '=', 'teachers_detail.users_id')
        ->select('comments.*', 'users.name', 'teachers_detail.imgPath');

        $comments = Comment::where('comments.articles_id', $request->articles_id)
        ->where('comments.users_id', Auth::user()->id)
        ->where('comments.body', $credentials['body'])
        ->join('users', 'comments.users_id', '=', 'users.id')
        ->join('users_detail', 'comments.users_id', '=', 'users_detail.users_id')
        ->select('comments.*', 'users.name as name', 'users_detail.imgPath')
        ->union($teacher)
        ->get();

        $result = [];

        foreach($comments as $comment) {
            $result[] = array(
                'id' => $comment->id,
                'articles_id' => $comment->articles_id,
                'users_id' => $comment->users_id,
                'body' => $comment->body,
                'created_at' => $comment->created_at->format('Y-m-d H:i:s'),
                'name' => $comment->name,
                'imgPath' => $comment->imgPath,
            );
        }
        header('Content-type: application/json');
        return json_encode($result);
    }


    /**
     * 非同期コメント削除機能
     *
     * @param Request $request
     * @return json
     */
    public function commentDelete(Request $request) {
        Comment::where('id', $request->id)
            ->update([
                'del_fg' => 1,
            ]);

        $id = [
            'id' => $request->id
        ];

        return json_encode($id);
    }
}
