<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'schools_id',
        'role',
    ];

    /**
     * schoolsテーブルへのリレーション
     *
     * @return BelongsTo
     */
    public function schools() {
        return $this->belongsTo(School::class);
    }

    /**
     * users_detailテーブルへのリレーション
     *
     * @return HasOne
     */
    public function users_detail() {
        return $this->hasOne(UserDetail::class, 'users_id');
    }

    /**
     * teachers_detailへのリレーション
     *
     * @return HasOne
     */
    public function teachers_detail() {
        return $this->hasOne(TeacherDetail::class, 'users_id');
    }

    /**
     * articlesテーブルへのrelation
     *
     * @return HasMany
     */
    public function articles() {
        return $this->hasMany(Article::class);
    }
    
    /**
     * commentsテーブルへのリレーション
     *
     * @return HasMany
     */
    public function comments() {
        return $this->hasMany(Comment::class, 'users_id');
    }

    /**
     * likesテーブルへのrelation
     *
     * @return HasMany
     */
    public function likes() {
        return $this->hasMany(Likes::class);
    }

    /**
     * 保護者編集用の詳細取得
     *
     * @param integer $id
     * @return collection
     */
    public function userDetail($id) {
        return $this->find($id)->users_detail;
    }

    /**
     * 先生編集用の詳細取得
     *
     * @param integer $id
     * @return collection
     */
    public function teacherDetail($id) {
        return $this->find($id)->teachers_detail;
    }

    /**
     * usersテーブルのupdate
     *
     * @param integer $id
     * @param string $name
     * @param string $email
     */
    public function userUpdate($id, $name, $email) {
        $this->where('id', $id)
            ->update([
                'name' => $name,
                'email' => $email,
            ]);
    }

    /**
     * users_detailテーブルのupdate imgあり
     *
     * @param integer $id
     * @param string $grade
     * @param string $class
     * @param string $onething
     * @param string $path
     * @param string $tel
     * @param string $address
     * @param string $emergency
     * @param string $relationship
     */
    public function userDetailUpdate($id, $grade, $class, $onething, $path, $tel, $address, $emergency, $relationship) {
        $this->find($id)->users_detail
            ->update([
                'grade' => $grade,
                'class' => $class,
                'onething' => $onething,
                'imgPath' => $path,
                'tel' => $tel,
                'address' => $address,
                'emergency' => $emergency,
                'relationship' => $relationship,
            ]);
    }

    /**
     * users_detailテーブルのupdate imgなし
     *
     * @param integer $id
     * @param string $grade
     * @param string $class
     * @param string $onething
     * @param string $tel
     * @param string $address
     * @param string $emergency
     * @param string $relationship
     */
    public function userDetailUpdateNoImg($id, $grade, $class, $onething, $tel, $address, $emergency, $relationship) {
        $this->find($id)->users_detail
            ->update([
                'grade' => $grade,
                'class' => $class,
                'onething' => $onething,
                'tel' => $tel,
                'address' => $address,
                'emergency' => $emergency,
                'relationship' => $relationship,
            ]);
    }

    /**
     * teachers_detailテーブルのupdate imgなし
     *
     * @param integer $id
     * @param string $jobs
     * @param integer $grade
     * @param integer $class
     * @param string $introduction
     */
    public function teacherDetailUpdateNoImg($id, $jobs, $grade, $class, $introduction) {
        $this->find($id)->teachers_detail
            ->update([
                'jobs' => $jobs,
                'grade' => $grade,
                'class' => $class,
                'introduction' => $introduction,
            ]);
    }

    /**
     * teachers_detailテーブルのupdate imgあり
     *
     * @param integer $id
     * @param string $jobs
     * @param integer $grade
     * @param integer $class
     * @param string $img
     * @param string $introduction
     */
    public function teacherDetailUpdate($id, $jobs, $grade, $class, $img, $introduction) {
        $this->find($id)->teachers_detail
            ->update([
                'jobs' => $jobs,
                'grade' => $grade,
                'class' => $class,
                'imgPath' => $img,
                'introduction' => $introduction,
            ]);
    }
}
