@extends('layouts.loginLayout')
@section('content')
  <form class="form" action="{{ route('schoolCheck') }}" method="POST">
    @csrf
    @error('error')
    <p class="error">{{ $message }}</p>
    @enderror
    @error('code')
      <p class="error">{{ $message }}</p>
    @enderror
    <input class="input" type="text" name="code" placeholder="学校コード" value="{{ old('code') }}">
    <input class="submit" type="submit" value="入力">
  </form>
  <a class="back" href="{{ route('top') }}">戻る</a>
@endsection
