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
}
