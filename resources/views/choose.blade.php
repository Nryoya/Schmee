@extends('layouts.loginLayout')
@section('content')
  <div class="choose__foot">
    <a class="choose__btn" href="{{ route('login') }}">ログイン</a>
    <a class="choose__btn" href="{{ route('code') }}">新規登録</a>
    <a class="choose__btn" href="{{ route('password_reset.email.form') }}">パスワードを忘れた方</a>
  </div>
@endsection
