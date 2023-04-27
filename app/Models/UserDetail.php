<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'users_detail';

    protected $fillable = [
        'users_id',
        'grade',
        'class',
        'onething',
        'imgPath',
        'tel',
        'address',
        'emergency',
        'relationship',
    ];

    /**
     * usersテーブルへのリレーション
     *
     * @return BelongsTo
     */
    public function users() {
        return $this->belongsTo(User::class);
    }
}
