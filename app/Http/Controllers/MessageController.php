<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * 部屋番号と一致するメッセージの取得
     *
     * @param integer $room_id
     * @param integer $user_id
     * @param Message $message
     * @param User $user
     * @return view
     */
    public function inRoom($room_id, $user_id, Message $message, User $user) {
        $result = $message->getMessage($room_id);
        $person = $user->getUser($user_id);

        return view('chat.message', ['result' => $result, 'room_id' => $room_id, 'person' => $person]);
    }

    /**
     * メッセージの挿入
     *
     * @param Request $request
     * @param Message $message
     * @return json $json
     */
    public function ControllerInsert(Request $request, Message $message) {
        $result = $message->modelInsert($request->room_id, $request->user_id, $request->message, 0);
            $json = [
                'id' => $result->id,
                'rooms_id' => $result->rooms_id,
                'users_id' => $result->users_id,
                'message' => $result->message,
                'created_at' => $result->created_at->format('Y-m-d H:i:s'),
            ];
        header('Content-type:application/json');
        return json_encode($json);
    }

    /**
     * メッセージを論理削除
     *
     * @param Request $request
     * @param Message $message
     * @return void
     */
    public function controllerMessageDelete(Request $request, Message $message) {
        $result = $message->modelMessageDelete($request->id);
        return json_encode($result);
    }
}
