@extends('layouts.loginLayout')
@section('content')
  <h2 class="from__headline">新しいパスワードを設定</h2>
  <form class="form" method="POST" action="{{ route('password_reset.update') }}">
    @csrf
    @error('token')
      <div class="error">{{ $message }}</div>
    @enderror
    <input type="hidden" name="reset_token" value="{{ $userToken->token }}">
    @error('password')
        <div class="error">{{ $message }}</div>
    @enderror
    <input type="password" name="password" class="input" placeholder="新しいパスワード">
    <input type="password" name="password_confirmation" class="input" placeholder="新しいパスワードを再入力">
    <input type="submit" class="submit" value="パスワードを再設定">
  </form>
@endsection