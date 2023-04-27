<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function() {
    // ゲスト
    Route::get('/', function() {
        return view('choose');
    })->name('top');
    
    Route::get('login', function() {
        return view('login');
    })->name('login');
    
    Route::post('loginResult', [UserController::class, 'login'])->name('loginResult');

    Route::get('code', function() {
        return view('code');
    })->name('code');
    
    Route::post('check', [UserController::class, 'codeCheck'])->name('check');

    Route::get('signup', function() {
        if(!session('name')) {
            return view('code');
        }
        return view('signup');
    })->name('signup');

    Route::post('insert', [UserController::class, 'insert'])->name('insert');

    Route::get('teacherCode', function() {
        return view('teacherCode');
    })->name('teacherCode');

    Route::post('schoolCheck', [UserController::class, 'schoolCheck'])->name('schoolCheck');
    
    Route::get('teacherSignup', function() {
        return view('teacherSignup');
    });

    Route::post('teacherInsert', [UserController::class, 'teacherInsert'])->name('teacherInsert');
    
    Route::get('forget', function() {
        return view('forget');
    })->name('forget');
});

Route::middleware(['auth'])->group(function() {
    // ユーザー
    Route::get('logout', [UserController::class, 'logout'])->name('logout');

    Route::get('firstRegister' ,function() {
        return view('firstRegister');
    })->name('firstRegister');

    Route::post('userDetail', [UserController::class, 'userDetail'])->name('userDetail');

    Route::get('myEdit/{role}/{id}', [UserController::class, 'myDetail'])->name('myEdit');

    Route::PATCH('myDetailUpdate', [UserController::class, 'myDetailUpdate'])->name('myDetailUpdate');
    
    Route::get('firstRegisterTeacher', function() {
        return view('firstRegisterTeacher');
    });

    // Route::post('teacherDetail', [UserController::class, 'teacherDetail'])->name('teacherDetail');
    
    Route::get('mypage/{id}', [UserController::class, 'getMyDetail'])->name('mypage');
    
    // Route::get('articles', [ArticleController::class, 'articleAll'])->name('articles');
    Route::get('articles', [ArticleController::class, 'getAllArticle'])->name('articles');

    Route::post('/like', [LikeController::class, 'like']);
    
    // Route::get('articleDetail/{id}', [ArticleController::class, 'userArticleDetail'])->name('articleDetail');
    Route::get('articleDetail/{id}', [ArticleController::class, 'getFindArticle'])->name('articleDetail');

    Route::get('articleDelete/{id}', [ArticleController::class, 'updateDelFg'])->name('updateDelFg');

    Route::post('/articleDetail/comment', [CommentController::class, 'comment'])->name('comment');

    Route::post('/commentDelete', [CommentController::class, 'commentDelete']);
    
    Route::get('articlePost', function() {
        return view('articlePost');
    })->name('articlePost');

    Route::post('post', [ArticleController::class, 'post'])->name('postCreate');
    
    Route::get('users', [UserController::class, 'getAllUser'])->name('users');
    
    Route::get('userDetail/{id}', [UserController::class, 'getFindUser'])->name('user');

    Route::get('teacherDetail/{id}', [UserController::class, 'getTeacherDetail'])->name('getTeacherDetail');
    
    Route::get('search', function () {
        return view('search');
    })->name('search');
    
    Route::get('messageList', function () {
        return view('messageList');
    })->name('messageList');
    
    Route::get('message', function () {
        return view('message');
    })->name('message');
    
    // admin
    Route::get('admin',[SchoolController::class, 'all'])->name('admin');
    
    Route::get('admin/Register', function() {
        return view('admin.adminSchoolRegister');
    })->name('adminRegister');

    Route::post('admin/RegisterResult', [SchoolController::class, 'create'])->name('schoolRegister');
    
    Route::get('admin/Representative', function () {
        return view('admin.adminRepresentative');
    });
    
    Route::post('admin/RepresentativeResult', [UserController::class, 'representative'])->name('representativeRegister');

    Route::get('admin/SchoolDetail/{id}',[SchoolController::class, 'getDetail'])->name('adminSchoolDetail');
    
    Route::get('admin/BySchoolUsers/{id}', [UserController::class, 'bySchoolUsers'])->name('adminBySchoolUsers');

    Route::get('admin/TeacherDetail/{id}', [UserController::class, 'teacherDetailAll'])->name('adminTeacherDetail');
    Route::get('admin/UserDetail/{id}', [UserController::class, 'userDetailAll'])->name('adminUserDetail');
    
    Route::get('admin/ByArticles/{id}', [ArticleController::class, 'bySchoolArticles'])->name('adminByArticles');
    
    Route::get('admin/ArticleDetail/{id}', [ArticleController::class, 'adminArticleDetail'])->name('adminArticleDetail');
});