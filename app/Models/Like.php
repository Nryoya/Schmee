<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'articles_id',
    ];

    /**
     * usersテーブルへのrelation
     *
     * @return BelongsTo
     */
    public function users() {
        return $this->belongsTo(User::class);
    }

    /**
     * articlesテーブルへのrelation
     *
     * @return BelongsTo
     */
    public function articles() {
        return $this->belongsTo(Article::class, 'articles_id');
    }

    /**
     * likeしているユーザーを取得
     *
     * @param integer $article_id
     * @return \Illuminate\Support\Collection
     */
    public function fetchUserWhoLike(int $article_id): \Illuminate\Support\Collection
    {
        return $this->where('articles_id', $article_id)->get();
    }
}
