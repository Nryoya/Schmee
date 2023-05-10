<?php

namespace App\Repositories\Eloquents;

use App\Models\Article;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ArticleRepository implements ArticleRepositoryInterface
{
    private $article;

    /**
     * コンストラクト
     *
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * @inheritDoc
     */
    public function postCreateIsImg(object $post_data): object
    {
        return $this->article->create([
            'title' => $post_data['ttl'],
            'body' => $post_data['body'],
            'articleImg' => $post_data['path'],
            'schools_id' => Auth::user()->schools_id,
            'users_id' => Auth::user()->id,
            'grade' => $post_data['grade'],
            'class' => $post_data['class'],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function postCreate(object $post_data): object
    {
        return $this->article->create([
            'title' => $post_data['ttl'],
            'body' => $post_data['body'],
            'schools_id' => Auth::user()->schools_id,
            'users_id' => Auth::user()->id,
            'grade' => $post_data['grade'],
            'class' => $post_data['class'],
        ]);
    }
}