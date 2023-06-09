<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\School;

class SchoolController extends Controller
{
    // admin
    /**
     * 学校取得機能
     *
     * @param School $school
     * @return view
     */
    public function controllerGetSchool(School $school) {
        $representatives = $school->modelGetSchool();

        return view('admin.school_lists', ['representatives' => $representatives]);
    }

    /**
     * 学校詳細取得機能
     *
     * @param School $school
     * @param integer $school_id
     * @return view
     */
    public function controllerGetSchoolDetail(School $school, $school_id) {
        $representative = $school->modelGetSchoolDetail($school_id);

        return view('admin.school_detail', ['representative' => $representative]);
    }

    /**
     * 学校検索機能
     *
     * @param Request $request
     * @return view
     */
    public function controllerSearchSchool(Request $request, School $school) {
        $keyword = $request->input('search');
        $schools =$school->modelSearchSchool($keyword);

        return view('admin.search_result_school', ['schools' => $schools]);
    }

    /**
     * 学校詳細編集画面表示
     *
     * @param School $school
     * @return view
     */
    public function controllerUpdateShow(School $school, $school_id) {
        $representative = $school->modelGetSchoolDetail($school_id);

        return view('admin.school_update_detail', ['representative' => $representative]);
    } 

    /**
     * 学校編集機能
     *
     * @param Request $request
     * @param School $school
     * @return redirect
     */
    public function controllerUpdateSchool(Request $request, School $school) {
        $credentials = $request->validate([
            'id' => ['required'],
            'code' => ['required', 'regex:/^[A-Z]{1}[0-9]{12}$/'],
            'name' => ['required'],
            'address' => ['required'],
            'tel' => ['required', 'digits_between:10,11'],
        ]);
        $school->modelUpdateSchool($credentials);

        return redirect(route('schoolDetail', $request->id));
    }

    /**
     * 学校削除機能
     *
     * @param integer $school_id
     * @param School $school
     * @return redirect
     */
    public function controllerDeleteSchool($school_id, School $school) {
        $school->modelDeleteSchool($school_id);

        return redirect(route('admin'));
    }

    /**
     * 学校登録
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request): \Illuminate\Http\RedirectResponse
    {
        // バリデーション
        $credentials = $request->validate([
            'code' => ['required', 'regex:/^[A-Z]{1}[0-9]{12}$/'],
            'name' => ['required'],
            'address' => ['required'],
            'tel' => ['required', 'digits_between:10,11'],
        ]);
        // 挿入
        $school = School::create([
            'code' => $credentials['code'],
            'name' => $credentials['name'],
            'address' => $credentials['address'],
            'tel' => $credentials['tel'],
        ]);

        return redirect()->route('showRepresentative', ['school_id' => $school->id]);
    }
}
