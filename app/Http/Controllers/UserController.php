<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\teacherDetail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * ログイン処理
     *
     * @param Request $request
     * @return Redirect articlesにリダイレクト
     */
    public function login(Request $request) {
        // バリデーション
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // 認証
        if (Auth::attempt($credentials)) {
            // セッションの再生成
            $request->session()->regenerate();
            // ロールで遷移先を変更
            if(Auth::user()->role  == 3) {
                return redirect('admin');
            } else if(Auth::user()->role == 2 || Auth::user()->role == 1) {
                $detail = TeacherDetail::where('users_id', Auth::user()->id)
                    ->get();
                session([
                    'grade' => $detail[0]->grade,
                    'class' => $detail[0]->class,
                    'imgPath' => $detail[0]->imgPath,
                ]);
                return redirect('articles');
            } else {
                $detail = UserDetail::where('users_id', Auth::user()->id)
                    ->get();
                session([
                    'grade' => $detail[0]->grade,
                    'class' => $detail[0]->class,
                    'imgPath' => $detail[0]->imgPath,
                ]);
                return redirect('articles');
            }
        }
        return back()->withErrors([
            'error' => '*メールアドレスかパスワードが違います。'
        ])->withInput();
    }

    /**
     * マイページ
     *
     * @param integer $id
     * @return view
     */
    public function getMyDetail($id) {
        $user = User::find($id);
        return view('mypage', compact('user'));
    }

    /**
     * ログアウト処理
     *
     * @param Request $request
     * @return redirect /にリダイレクト
     */
    public function logout(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
    }

    // admin
    /**
     * 代表者登録
     *
     * @param Request $request
     * @return view
     */
    public function representative(Request $request, User $user) {
        // バリデーション
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'schools_id' => [],
        ]);
        $user_data = $user->modelRepresentativeInsert($credentials);

        return view('admin.user_detail_register', ['user_data' => $user_data]);
    }

    /**
     * 代表者詳細登録機能
     *
     * @param Request $request
     * @param TeacherDetail $teacher_detail
     * @return redirect
     */
    public function representativeDetail(Request $request, TeacherDetail $teacher_detail) {
        // バリデーション
        $credentials = $request->validate([
            'id' => ['required'],
            'jobs' => ['required'],
            'introduction' => ['required', 'max:250'],
        ]);
        $teacher_detail->modelRepresentativeDetail($credentials);

        return redirect('admin');
    }

    /**
     * 学校IDと一致するユーザーの取得
     *
     * @param integer $id 学校ID
     * @return view //adminBySchoolUsersに返す
     */ 
    public function bySchoolUsers($id) {
        $users = User::where('schools_id', $id)
            ->join('users_detail', 'users.id', '=', 'users_detail.users_id')
            ->select('users.id', 'users_detail.imgPath', 'users_detail.grade', 'users_detail.class', 'users.name')
            ->get();

        $teachers = User::where('schools_id', $id)
        ->join('teachers_detail', 'users.id', '=', 'teachers_detail.users_id')
        ->select('users.id','teachers_detail.imgPath', 'teachers_detail.jobs', 'users.name')
        ->get();
        return view('admin.adminBySchoolUsers', compact('users', 'teachers'));
    }

    /**
     * 保護者詳細取得
     *
     * @param integer $id ユーザーID
     * @return view //adminUserDetailに返す
     */
    public function userDetailAll($id) {
        $user_detail = User::where('users.id', $id)
            ->join('users_detail', 'users.id', '=', 'users_detail.users_id')
            ->select('users.*', 'users_detail.*')
            ->get();

        return view('admin.adminUserDetail', compact('user_detail'));
    }

    /**
     * 関係者詳細取得
     *
     * @param integer $id ユーザーID
     * @return view adminTeacherDetailに返す
     */ 
    public function teacherDetailAll($id) {
        $teacher_detail = User::where('users.id', $id)
        ->join('teachers_detail', 'users.id', '=', 'teachers_detail.users_id')
        ->select('users.*', 'teachers_detail.*')
        ->get();

    return view('admin.adminTeacherDetail', compact('teacher_detail'));
    }
    
    // 保護者新規登録
    /**
     * 学校チェック
     *
     * @param Request $request
     * @return redirect signupにリダイレクト
     */
    public function codeCheck(Request $request) {
        // バリデーション
        $credentials = $request->validate([
            // 必須、英語１文字と数字
            'code' => ['required', 'regex:/^[A-Z]{1}[0-9]{12}$/'],
        ]);
        // 学校コードのチェック
        $bool = School::where('code', $credentials['code'])->exists();
        if($bool) {
            $result = School::where('code', $credentials['code'])->get();
            session([
                'id' => $result[0]->id,
                'name' => $result[0]->name,
            ]);
            return redirect('signup');
        } else {
            return back()->withErrors([
                'error' => '*学校コードが存在しません。'
            ])->withInput();
        }
    }

    /**
     * 保護者挿入
     *
     * @param Request $request
     * @return redirect firstRegisterにリダイレクト
     */
    public function insert(Request $request) {
        // バリデーション
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'schools_id' => [],
        ]);
        // データの挿入
        User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
            'schools_id' => $credentials['schools_id'],
            'role' => 0,
        ]);
        // 認証
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            // セッションの再生成
            $request->session()->regenerate();
        }
        return redirect('firstRegister');
    }

    /**
     * 保護者詳細登録
     *
     * @param Request $request
     * @return redirect articlesにリダイレクト
     */
    public function userDetail(Request $request) {
        // バリデーション
        $credentials = $request->validate([
            'grade' => ['required', 'max:1'],
            'class' => ['required', 'max:1'],
            'onething' => ['required', 'max:50'],
            'tel' => ['required', 'digits_between:10,11'],
            'address' =>['required', 'max:50'],
            'emergency' => ['required', 'digits_between:10,11'],
            'relationship' => ['required'],
        ]);
        // imgの取得
        $img = $request->file('imgPath');
        // imgに値が入っていれば
        if(isset($img)) {
            $path = $img->store('img', 'public');
            UserDetail::create([
                'users_id' => $request->id,
                'grade' => $credentials['grade'],
                'class' => $credentials['class'],
                'onething' => $credentials['onething'],
                'imgPath' => $path,
                'tel' => $credentials['tel'],
                'address' => $credentials['address'],
                'emergency' => $credentials['emergency'],
                'relationship' => $credentials['relationship'],
            ]);
        } else {
            UserDetail::create([
                'users_id' => $request->id,
                'grade' => $credentials['grade'],
                'class' => $credentials['class'],
                'onething' => $credentials['onething'],
                'tel' => $credentials['tel'],
                'address' => $credentials['address'],
                'emergency' => $credentials['emergency'],
                'relationship' => $credentials['relationship'],
            ]);
        }
        return redirect('articles');
    }

    // 関係者新規登録
    /**
     * 学校IDのチェック
     *
     * @param Request $request
     * @return redirect teacherSignupにリダイレクト
     */
    public function schoolCheck(Request $request) {
        // バリデーション
        $credentials = $request->validate([
            // 必須、英語１文字と数字
            'code' => ['required', 'regex:/^[A-Z]{1}[0-9]{12}$/'],
        ]);
        // 学校コードのチェック
        $bool = School::where('code', $credentials['code'])->exists();
        if($bool) {
            $result = School::where('code', $credentials['code'])->get();
            session([
                'id' => $result[0]->id,
                'name' => $result[0]->name,
            ]);
            return redirect('teacherSignup');
        } else {
            return back()->withErrors([
                'error' => '*学校コードが存在しません。'
            ])->withInput();
        }
    }

    /**
     * 関係者登録
     *
     * @param Request $request
     * @return redirect firstRegisterTeacherにリダイレクト
     */
    public function teacherInsert(Request $request) {
        // バリデーション
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'schools_id' => [],
        ]);
        // データの挿入
        User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
            'schools_id' => $credentials['schools_id'],
            'role' => 1,
        ]);
        // 認証
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            // セッションの再生成
            $request->session()->regenerate();
        }
        return redirect('firstRegisterTeacher');
    }

    /**
     * 関係者詳細登録
     *
     * @param Request $request
     * @return redirect articlesにリダイレクト
     */
    public function teacherDetail(Request $request) {
        $grade = $request->input('grade');
        if(isset($grade)) {
            // バリデーション
            $credentials = $request->validate([
                'jobs' => ['required'],
                'grade' => ['max:1'],
                'class' => ['max:1'],
                'introduction' => ['required', 'max:250'],
            ]);

            // imgの取得
            $img = $request->file('imgPath');
            // imgに値が入っていれば
            if(isset($img)) {
                $path = $img->store('img', 'public');
                TeacherDetail::create([
                    'users_id' => $request->id,
                    'jobs' => $credentials['jobs'],
                    'grade' => $credentials['grade'],
                    'class' => $credentials['class'],
                    'imgPath' => $path,
                    'introduction' => $credentials['introduction'],
                ]);
            } else {
                TeacherDetail::create([
                    'users_id' => $request->id,
                    'jobs' => $credentials['jobs'],
                    'grade' => $credentials['grade'],
                    'class' => $credentials['class'],
                    'introduction' => $credentials['introduction'],
                ]);
            }
            return redirect('articles');
        } else {
            // バリデーション
            $credentials = $request->validate([
                'jobs' => ['required'],
                'introduction' => ['required', 'max:250'],
            ]);

            // imgの取得
            $img = $request->file('imgPath');
            // imgに値が入っていれば
            if(isset($img)) {
                $path = $img->store('img', 'public');
                TeacherDetail::create([
                    'users_id' => $request->id,
                    'jobs' => $credentials['jobs'],
                    'imgPath' => $path,
                    'introduction' => $credentials['introduction'],
                ]);
            } else {
                TeacherDetail::create([
                    'users_id' => $request->id,
                    'jobs' => $credentials['jobs'],
                    'introduction' => $credentials['introduction'],
                ]);
            }
            return redirect('articles');
        }
    }

    // /**
    //  * 保護者詳細取得
    //  *
    //  * @param integer $id ユーザーID
    //  * @return view //userDetailに返す
    //  */
    // public function getUserDetail($id) {
    //     $user_detail = User::where('users.id', $id)
    //         ->join('users_detail', 'users.id', '=', 'users_detail.users_id')
    //         ->select('users.*', 'users_detail.*')
    //         ->get();

    //     return view('userDetail', compact('user_detail'));
    // }

    // /**
    //  * 関係者詳細取得
    //  *
    //  * @param integer $id ユーザーID
    //  * @return view teacherDetailに返す
    //  */ 
    // public function getTeacherDetail($id) {
    //     $teacher_detail = User::where('users.id', $id)
    //     ->join('teachers_detail', 'users.id', '=', 'teachers_detail.users_id')
    //     ->select('users.*', 'teachers_detail.*')
    //     ->get();

    // return view('teacherDetail', compact('teacher_detail'));
    // }


    /**
     * usersテーブルから同じ学校のデータを取得
     *
     * @return view
     */
    public function ControllerGetAllUser(User $user) {
        $users = $user->modelGetAllUser(Auth::user()->schools_id);
        return view('users', compact('users'));
    }

    /**
     *  usersテーブルから検索結果を取得
     *
     * @param Request $request
     * @param User $user
     * @return view usersRe
     */
    public function controllerSearchUser(Request $request, User $user) {
        $keyword = $request->input('search');
        $users = $user->modelSearchUser(['role' => Auth::user()->role, 'school_id' => Auth::user()->schools_id, 'keyword' => $keyword]);
        return view('search_result_user',compact('users'));
    }

    /**
     * usersテーブルから$idと一致するデータを取得
     *
     * @param integer $id
     * @return view
     */
    public function getFindUser($id) {
        $users = User::find($id);
        return view('userDetail', compact('users'));
    }

    /**
     * my_edit用ユーザー詳細取得
     *
     * @param integer $role
     * @param integer $id
     * @param User $user
     * @return view
     */
    public function myDetail($role, $id, User $user) {
        if($role == 0) {
            $detail = $user->userDetail($id);
        } else {
            $detail = $user->teacherDetail($id);
        }
        return view('my_edit', compact('detail'));
    }


    /**
     * ユーザーの詳細編集
     *
     * @param Request $request
     * @param User $user
     * @return redirect mypage
     */
    public function myDetailUpdate(Request $request, User $user) {
        if(Auth::user()->role == 0) {
            $credentials = $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email'],
                'grade' => ['required'],
                'class' => ['required'],
                'onething' => ['required', 'max:50'],
                'tel' => ['required',  'digits_between:10,11'],
                'address' => ['required', 'max:50'],
                'emergency' => ['required',  'digits_between:10,11'],
                'relationship' => ['required'],
            ]);
            $user->userUpdate($request->id, $credentials['name'], $credentials['email']);
            if($request->imgPath) {
                $img = $request->file('imgPath');
                $path = $img->store('img', 'public');
                $user->userDetailUpdate($request->id, $credentials['grade'], $credentials['class'], $credentials['onething'], $path, $credentials['tel'], $credentials['address'], $credentials['emergency'], $credentials['relationship']);
            } else {
                $user->userDetailUpdateNoImg($request->id, $credentials['grade'], $credentials['class'], $credentials['onething'], $credentials['tel'], $credentials['address'], $credentials['emergency'], $credentials['relationship']);
            }

        } else {
            $credentials = $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email'],
                'jobs' => ['required'],
                'grade' => ['required'],
                'class' => ['required'],
                'introduction' => ['required', 'max:250'],
            ]);
            $user->userUpdate($request->id, $credentials['name'], $credentials['email']);
            if($request->imgPath) {
                $img = $request->file('imgPath');
                $path = $img->store('img', 'public');
                $user->teacherDetailUpdate($request->id, $credentials['jobs'], $credentials['grade'], $credentials['class'], $path, $credentials['introduction']);
            } else {
                $user->teacherDetailUpdateNoImg($request->id, $credentials['jobs'], $credentials['grade'], $credentials['class'], $credentials['introduction']);
            }
            
        }
        return redirect(route('mypage', Auth::user()->id));
    }
}
