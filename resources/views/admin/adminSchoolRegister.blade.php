@extends('layouts.backLayout')
@section('content')
<form class="form form-margin-big" action="{{ route('schoolRegister') }}" method="post">
  @csrf
  <h2 class="from__headline">学校登録</h2>
  @error('code')
    <p class="error">{{ $message }}</p>
  @enderror
  <input class="input input--blue" type="text" name="code" placeholder="学校コード" value="{{ old('code') }}">
  @error('name')
    <p class="error">{{ $message }}</p>
  @enderror
  <input class="input input--blue" type="text" name="name" placeholder="学校名" value="{{ old('name') }}">
  @error('address')
    <p class="error">{{ $message }}</p>
  @enderror
  <input class="input input--blue" type="text" name="address" placeholder="学校住所" value="{{ old('address') }}">
  @error('tel')
    <p class="error">{{ $message }}</p>
  @enderror
  <input class="input input--blue" type="tel" name="tel" placeholder="学校電話番号" value="{{ old('tel') }}">
  <input class="submit submit--blue" type="submit" value="登録">  
</form>
@endsection