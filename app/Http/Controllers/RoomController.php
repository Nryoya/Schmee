<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RoomController extends Controller
{
    /**
     * roomの作成とページ遷移
     *
     * @param integer $id
     * @param string $name
     * @param Room $room
     * @return redirect
     */
    public function createRoom($id, $name, Room $room, User $user) {
        //相手とのroomが存在している時
        $my_rooms = Auth::user()->rooms;
        $your_rooms = $user->find($id)->rooms;
        foreach($my_rooms as $my_room) {
            for($i = 0; $i < count($your_rooms); $i++) {
                if($my_room->pivot->room_id == $your_rooms[$i]->pivot->room_id) {
                    return redirect(route('inRoom', [$my_room->pivot->room_id, $id]));
                }
            }
        }

        //相手とのroomが存在していない時
        $result = $room->register($name);
        $room->roomUser($result->id, $id);
        $room->roomUser($result->id, Auth::user()->id);
        return redirect(route('inRoom', [$result->id, $id]));
    }

    /**
     * ルームのリストを表示
     *
     * @param Room $room
     * @return view
     */
    public function getRoomList(Room $room) {
        $lists = $room->getList(Auth::user()->id);

        return view('chat.messageList', ['lists' => $lists]);
    }

}
