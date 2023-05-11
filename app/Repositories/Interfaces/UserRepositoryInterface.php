<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * 引数に渡されたメールアドレスを持つユーザーを取得する
     *
     * @param string $email
     * @return User
     */
    public function findFromEmail(string $email): User;

    /**
     * 引数に渡されたIDのユーザーのパスワードを更新する
     *
     * @param string $password
     * @param int $id
     * @return void
     */
    public function updateUserPassword(string $password, int $id): void;

    /**
     * 引数に渡されたschool_id、grade、class、roleを持つユーザーを取得する
     *
     * @param array $to_email_data
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFromSchoolGradeClassRole(array $to_email_data): \Illuminate\Database\Eloquent\Collection;

    /**
     * 引数に渡されたschool_id、grade、roleを持つユーザーを取得する
     *
     * @param array $to_email_data
     * @return \Illuminate\Database\Eloquent\Collection 
     */
    public function getFromSchoolGradeRole(array $to_email_data): \Illuminate\Database\Eloquent\Collection;

    /**
     * 引数に渡されたschool_id、roleを持つユーザーを取得する
     *
     * @param array $to_email_data
     * @return \Illuminate\Database\Eloquent\Collection 
     */
    public function getFromSchoolRole(array $to_email_data): \Illuminate\Database\Eloquent\Collection;
}