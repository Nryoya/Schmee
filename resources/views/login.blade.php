@extends('layouts.loginLayout')
@section('content')
  <form class="form" action="{{ route('loginResult') }}" method="POST">
    @csrf
    @error('error')
      <p class="error">{{ $message }}</p>
    @enderror
    @error('email')
    <p class="error">{{ $message }}</p>
  @enderror
    <input class="input" type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
    @error('password')
    <p class="error">{{ $message }}</p>
  @enderror
    <input class="input" type="password" name="password" placeholder="パスワード">
    <input class="submit" type="submit" value="ログイン">
  </form>
  <a class="back" href="{{ route('top') }}">戻る</a>
@endsection