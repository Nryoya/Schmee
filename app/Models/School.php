<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'address',
        'tel',
    ];

    /**
     * usersテーブルへのリレーション
     *
     * @return HasMany
     */
    public function users() {
        return $this->hasMany(User::class, 'schools_id');
    }

    /**
     * 学校取得
     *
     * @return void
     */
    public function modelGetSchool() {
        return User::query()
            ->where('role', 2)
            ->get();
    }

    /**
     * 学校詳細取得
     *
     * @param integer $school_id
     * @return object
     */
    public function modelGetSchoolDetail($school_id) {
        return user::query()
            ->where('role', 2)
            ->where('schools_id', $school_id)
            ->first();
    }

    /**
     * 学校検索
     *
     * @param string $keyword
     * @return collection
     */
    public function modelSearchSchool($keyword) {
        return $this->query()
            ->where('name', 'Like', '%'.$keyword.'%')
            ->orWhere('address', 'Like', '%'.$keyword.'%')
            ->orderBy('name', 'desc')
            ->get();
    }

    /**
     * 学校編集
     *
     * @param array $data
     * @return void
     */
    public function modelUpdateSchool($data) {
        $this->query()
            ->where('id', $data['id'])
            ->update([
                'code' => $data['code'],
                'name' => $data['name'],
                'address' => $data['address'],
                'tel' => $data['tel'],
            ]);
    }

    public function modelDeleteSchool($school_id) {
        $school = $this->query()
            ->where('id', $school_id)
            ->first();
    }
}
