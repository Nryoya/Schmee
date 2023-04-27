<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
