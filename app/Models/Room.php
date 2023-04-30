<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Eloquent\Relations\Pivot;


class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';
    protected $fillable = [
        'name',
    ];

    /**
     * usersテーブルへのリレーション
     *
     * @return BelongsToMany
     */
    public function users() {
        return $this->belongsToMany(User::class);
    }
    
    /**
     * messagesテーブルへのリレーション
     *
     * @return HasMany
     */
    public function messages() {
        return $this->hasMany(Messages::class);
    }

    /**
     * roomの生成
     *
     * @param string $name
     * @return object
     */
    public function register($name) {
        return $result = $this->create([
            'name' => $name,
        ]);
    }

    /**
     * room_userテーブルへの登録
     *
     * @param integer $room_id
     * @param integer $id
     * @return void
     */
    public function roomUser($room_id, $id) {
        $this->find($room_id)->users()->sync($id, false);
    }

    /**
     * 所属しているroomと相手を取得
     *
     * @param integer $id
     * @return array $users
     */
    public function getList($id) {
        $users = [];
        $rooms = User::find($id)->rooms;
        foreach($rooms as $room) {
            $room_id = $room->pivot->room_id;
            $persons = $room->users;
            foreach($persons as $person) {
                if($person->id != $id) {
                    $users[$room_id] = $room->users->find($person->id);
                }
            }
        }
        return $users;
    }


}
