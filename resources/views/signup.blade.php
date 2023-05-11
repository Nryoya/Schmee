@extends('layouts.loginLayout')
@section('content')
  <form class="form" action="{{ route('insert') }}" method="POST">
    @csrf
    <p class="code">学校名:{{ $school_name }}</p>
    <input type="hidden" name="schools_id" value="{{ $school_id }}">
    @error('name')
      <p class="error">{{ $message }}</p>
    @enderror
    <input class="input" type="text" name="name" placeholder="保護者名" value="{{ old('name') }}">
    @error('email')
    <p class="error">{{ $message }}</p>
    @enderror
    <input class="input" type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
    @error('password')
    <p class="error">{{ $message }}</p>
    @enderror
    <input class="input" type="password" name="password" placeholder="パスワード">
    <input class="submit" type="submit" value="新規登録">
  </form>
  <a class="back" href="{{ route('code') }}">戻る</a>
@endsection