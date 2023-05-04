@extends('layouts.backLayout')
@section('content')
<form class="form form-margin-big" action="{{ route('schoolUpdate') }}" method="POST">
  @method('PATCH')
  @csrf
  <h2 class="from__headline">編集</h2>
  <input type="hidden" value="{{ $representative->schools->id }}" name="id">
  @error('code')
    <p class="error">{{ $message }}</p>
  @enderror
  <input class="input input--blue input--margin-top" type="text" placeholder="学校コード" name="code" value="{{ old('code', $representative->schools->code) }}">
  @error('name')
    <p class="error">{{ $message }}</p>
  @enderror
  <input class="input input--blue" type="text" placeholder="名前" name="name" value="{{ old('name', $representative->schools->name) }}">
  @error('address')
    <p class="error">{{ $message }}</p>
  @enderror
  <input class="input input--blue" type="text" name="address" placeholder="住所" value="{{ old('onething', $representative->schools->address) }}">
  @error('tel')
    <p class="error">{{ $message }}</p>
  @enderror
  <input class="input input--blue" type="tel" placeholder="電話番号" name="tel" value="{{ old('tel', $representative->schools->tel) }}">
  <input class="submit submit--blue" type="submit" value="編集">
</form>
@endsection