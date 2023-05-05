<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherDetail extends Model
{
    use HasFactory;

    protected $table = 'teachers_detail';

    protected $fillable = [
        'users_id',
        'jobs',
        'grade',
        'class',
        'imgPath',
        'introduction',
    ];

    /**
     * usersテーブルへのリレーション
     *
     * @return belongsTo
     */
    public function users() {
        return $this->belongsTo(User::class);
    }

    /**
     * 代表者詳細登録
     *
     * @param array $user_data
     * @return void
     */
    public function modelRepresentativeDetail($user_data) {
        TeacherDetail::create([
            'users_id' => $user_data['id'],
            'jobs' => $user_data['jobs'],
            'introduction' => $user_data['introduction'],
        ]);
    }
}
