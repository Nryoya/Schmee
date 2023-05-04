<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'rooms_id',
        'users_id',
        'message',
        'del_fg',
    ];

    /**
     * usersテーブルへのリレーション
     *
     * @return BelongsTo
     */
    public function users() {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * roomsテーブルへのリレーション
     *
     * @return BelongsTo
     */
    public function rooms() {
        return $this->belongsTo(Room::class);
    }


    /**
     * メッセージの取得
     *
     * @param integer $id
     * @return void
     */
    public function getMessage($id) {
        return $result = $this->where('rooms_id', $id)->where('del_fg', 0)->get();
    }

    /**
     * メッセージの挿入
     *
     * @param integer $room_id
     * @param integer $user_id
     * @param string $message
     * @param integer $del_fg
     * @return collection $message
     */
    public function modelInsert($room_id, $user_id, $body, $del_fg) {
        $message = $this->create([
            'rooms_id' => $room_id,
            'users_id' => $user_id,
            'message' => $body,
            'del_fg' => $del_fg,
        ]);
        return $message;
    }

    public function modelMessageDelete($id) {
        $target = $this->where('id', $id)->update([
            'del_fg' => 1
        ]);
        return $target;
    }
}
