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
        return $result = $this->where('rooms_id', $id)->get();
    }
}
