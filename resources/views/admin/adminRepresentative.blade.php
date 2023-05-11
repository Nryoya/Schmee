@extends('layouts.backLayout')
@section('content')
<form class="form form-margin-big" action="{{ route('representativeRegister') }}" method="POST">
  @csrf
  <h2 class="from__headline">学校代表者登録</h2>
  <input type="hidden" name="schools_id" value="{{ $school_id }}">
  @error('name')
    <p class="error">{{ $message }}</p>
  @enderror
  <input class="input input--blue" type="text" name="name" placeholder="代表者名">
  @error('email')
    <p class="error">{{ $message }}</p>
  @enderror
  <input class="input input--blue" type="email" name="email" placeholder="メールアドレス">
  @error('password')
    <p class="error">{{ $message }}</p>
  @enderror
  <input class="input input--blue" type="text" name="password" placeholder="初期パスワード">
  <input class="submit submit--blue" type="submit" value="登録">
</form>
@endsection