@extends('layouts.loginLayout')
@section('content')
  <form class="form" action="#" method="POST">
    <input class="input" type="emil" name="email" placeholder="メールアドレス">
    <input class="submit" type="submit" value="メールを送る">
  </form>
  <a class="back" href="{{ route('top') }}">戻る</a>
@endsection