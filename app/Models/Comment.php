<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'articles_id',
        'users_id',
        'body',
        'del_fg',
        'created_at',
    ];

    /**
     * articlesテーブルへのリレーション
     *
     * @return BelongsTo
     */
    public function articles() {
        return $this->belongsTo(Article::class);
    }

    /**
     * usersテーブルへのリレーション
     *
     * @return void
     */
    public function users() {
        return $this->belongsTo(User::class);
    }
}
