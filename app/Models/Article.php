<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'imgPath',
        'schools_id',
        'users_id',
        'grade',
        'class',
        
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
     * likesテーブルへのrelation
     *
     * @return HasMany
     */
    public function likes() {
        return $this->hasMany(Like::class, 'articles_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'articles_id');
    }

    /**
     * 記事にいいねしているかどうか
     *
     * @param integer $user
     * @return boolean
     */
    public function isLikeBy($user) {
        return $this->likes()->where('users_id', $user)->exists();
    }

    /**
     * 記事の論理削除
     *
     * @param integer $id
     */
    public function logicalDelete($id) {
        return $this->where('id', $id)
            ->update([
                'del_fg' => 1
            ]);
    }
}
