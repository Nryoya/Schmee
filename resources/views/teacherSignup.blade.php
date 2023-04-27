@extends('layouts.loginLayout')
@section('content')
<form class="form" action="{{ route('teacherInsert') }}" method="POST">
  @csrf
  <p class="code">学校名:{{ session('name') }}</p>
  <input type="hidden" name="schools_id" value="{{ session('id') }}">
  @error('name')
    <p class="error">{{ $message }}</p>
  @enderror
  <input class="input" type="text" name="name" placeholder="関係者名" value="{{ old('name') }}">
  @error('email')
  <p class="error">{{ $message }}</p>
  @enderror
  <input class="input" type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
  @error('password')
  <p class="error">{{ $message }}</p>
  @enderror
  <input class="input" type="password" name="password" placeholder="パスワード" value="{{ old('password') }}">
  <input class="submit" type="submit" value="関係者 新規登録">
</form>
@endsection
