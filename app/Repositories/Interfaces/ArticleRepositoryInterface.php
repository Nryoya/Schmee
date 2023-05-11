<?php

namespace App\Repositories\Interfaces;

use App\Models\Article;

interface ArticleRepositoryInterface
{
    /**
     * 学校通信投稿(imgあり)
     *
     * @param object $post_data
     * @return object
     */
    public function postCreateIsImg(object $post_data): object;

    /**
     * 学校通信投稿(imgなし)
     *
     * @param array $post_data
     * @return object
     */
    public function postCreate(object $post_data): object;
}