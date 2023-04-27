<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\User;

class SchoolController extends Controller
{
    // admin
    /**
     * 学校の一覧表示
     *
     * @return view adminSchoolListsを返す
     */
    public function all() {
        $schools = User::where('users.role', 2)
            ->join('schools', 'users.schools_id', '=', 'schools.id')
            ->select('users.name as representative', 'schools.name', 'schools.id')
            ->orderby('schools.name', 'desc')
            ->get();

        return view('admin.adminSchoolLists', compact('schools'));
    }

    /**
     * 学校登録
     *
     * @param Request $request
     * @return view adminRepresentativeを返す
     */
    public function create(Request $request) {
        // バリデーション
        $credentials = $request->validate([
            'code' => ['required', 'regex:/^[A-Z]{1}[0-9]{12}$/'],
            'name' => ['required'],
            'address' => ['required'],
            'tel' => ['required', 'digits_between:10,11'],
        ]);
        // 挿入
        School::create([
            'code' => $credentials['code'],
            'name' => $credentials['name'],
            'address' => $credentials['address'],
            'tel' => $credentials['tel'],
        ]);
        // 登録したidの取得
        $id = school::where('name', $credentials['name'])->get('id');

        return view('admin.adminRepresentative', compact('id'));
    }

    /**
     * 学校詳細表示
     *
     * @param integer $id //代表者
     * @return view adminSchoolDetailを返す
     */
    public function getDetail($id) {
        // idと一致する学校を取得
        $detail = User::where('role', 2)
            ->where('schools_id', $id)
            ->join('schools', 'users.schools_id', '=', 'schools.id')
            ->select('schools.*', 'users.name as user', 'users.email')
            ->get();
            return view('admin.adminSchoolDetail', compact('detail'));
    }
}
