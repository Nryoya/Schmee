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
        'articleImg',
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
        return $this->belongsTo(User::class, 'users_id');
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

    /**
     * 保護者用記事の検索
     *
     * @param array $user
     * @param string $keyword
     * @return collection
     */
    public function modelSearchArticle($user, $keyword) {
        return $this->query()
            ->Where(function($query) use ($keyword) {
                $query->orWhere('title', 'Like', '%'.$keyword.'%')
                    ->orWhere('body', 'Like', '%'.$keyword.'%')
                    ->orWhereHas('users', function ($query) use ($keyword) {
                        $query->where('name', 'Like', '%'.$keyword.'%');
                    });
            })
            ->whereIn('grade', [$user['grade'], 0])
            ->whereIn('class', [$user['class'], 0])
            ->where('del_fg', 0)
            ->where('schools_id', $user['school_id'])
            ->get();
    }

    /**
     * 関係者用記事の検索
     *
     * @param array $user
     * @param string $keyword
     * @return void
     */
    public function modelSearchArticleSchool($user, $keyword) {
        return $this->query()
        ->Where(function($query) use ($keyword) {
            $query->orWhere('title', 'Like', '%'.$keyword.'%')
                ->orWhere('body', 'Like', '%'.$keyword.'%')
                ->orWhereHas('users', function ($query) use ($keyword) {
                    $query->where('name', 'Like', '%'.$keyword.'%');
                });
        })
        ->where('del_fg', 0)
        ->where('schools_id', $user['school_id'])
        ->get();
    }

    /**
     * 記事の一覧取得
     *
     * @param array $user_data
     * @return void
     */
    public function modelShowArticle($user_data) {
        return $this->query()
            ->where('schools_id', $user_data['school_id'])
            ->whereIn('grade', [$user_data['grade'], 0])
            ->whereIN('class', [$user_data['class'], 0])
            ->where('del_fg', 0)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /** 
     * admin
    */
    /**
     * 記事の一覧取得
     *
     * @param integer $school_id
     * @return void
     */
    public function modelShowArticleAll($school_id) {
        return $this->query()
            ->where('schools_id', $school_id)
            ->where('del_fg', 0)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * 記事の詳細取得
     *
     * @param integer $article_id
     * @return void
     */
    public function modelShowArticleDetail($article_id) {
        return $this->query()
            ->find($article_id);
    }

    /**
     * 記事の検索
     *
     * @param integer $school_id
     * @param string $keyword
     * @return void
     */
    public function modelAdminSearchArticle($school_id, $keyword) {
        return $this->query()
        ->Where(function($query) use ($keyword) {
            $query->orWhere('title', 'Like', '%'.$keyword.'%')
                ->orWhere('body', 'Like', '%'.$keyword.'%')
                ->orWhereHas('users', function ($query) use ($keyword) {
                    $query->where('name', 'Like', '%'.$keyword.'%');
                });
        })
        ->where('schools_id', $school_id)
        ->get();
    }
}
