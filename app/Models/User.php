<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\Hash;

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
        return $this->hasMany(Article::class, 'users_id');
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
        return $this->hasMany(Likes::class, 'users_id');
    }

    /**
     * roomsテーブルへのリレーション
     *
     * @return belongsToMany
     */
    public function rooms() {
        return $this->belongsToMany(Room::class);
    }

    /**
     * messagesテーブルへのリレーション
     *
     * @return HasMany
     */
    public function messages() {
        return $this->hasMany(Message::class, 'users_id');
    }

    public function modelRepresentativeInsert($user_data) {
        $user = User::create([
            'name' => $user_data['name'],
            'email' => $user_data['email'],
            'password' => Hash::make($user_data['password']),
            'schools_id' => $user_data['schools_id'],
            'role' => 2,
        ]);
        return $user;
    }

    /**
     * 同じ学校のユーザーを取得
     *
     * @param integer $school_id
     * @return collection
     */
    public function modelGetAllUser($school_id) {
        $users = $this->query()
            ->where('schools_id', $school_id)->get();
        return $users;
    }

    /**
     * 同じ学校且つキーワードに一致するユーザーを取得
     *
     * @param array $searchArray
     * @return collection $users
     */
    public function modelSearchUser($searchArray) {
        $users = $this->query()
            ->whereNot('role', $searchArray['role'])
            ->where('schools_id', $searchArray['school_id'])
            ->where('name', 'Like', '%'.$searchArray['keyword'].'%')
            ->get();
        return $users;
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

    /**
     * ユーザーの取得
     *
     * @param integer $id
     * @return collection
     */
    public function getUser($id) {
        return $this->find($id);
    }

    /**
     * admin
     */


    /**
     * 同じ学校且つキーワードに一致するユーザーを取得
     *
     * @param array $searchArray
     * @return collection $users
     */
    public function modelAdminSearchUser($searchArray) {
        $users = $this->query()
            ->where('schools_id', $searchArray['school_id'])
            ->where('name', 'Like', '%'.$searchArray['keyword'].'%')
            ->get();
        return $users;
    }

    /**
     * ユーザーの削除
     *
     * @param integer $user_id
     * @return void
     */
    public function modelUserDelete($user_id) {
        $school_id = $this->query()
            ->where('id', $user_id)
            ->select('schools_id')
            ->first();

        $this->query()
            ->where('id', $user_id)
            ->delete();

        return $school_id;
    }
}
