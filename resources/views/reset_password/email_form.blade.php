@extends('layouts.loginLayout')
@section('content')
  <form class="form" action="{{ route('password_reset.email.send') }}" method="POST">
    @csrf
    @error('email')
      <p class="error">{{ $message }}</p>
    @enderror
    <input class="input" type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
    <input class="submit" type="submit" value="メールを送る">
  </form>
  <a class="back" href="{{ route('top') }}">戻る</a>
@endsection