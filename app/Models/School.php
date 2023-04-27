<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
