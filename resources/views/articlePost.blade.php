@extends('layouts.userBackLayout')
@section('content')
  <form class="form form-margin-big" action="{{ route('postCreate') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h2 class="from__headline">学校通信投稿</h2>
    @error('ttl')
      <p class="error">{{ $message }}</p>
    @enderror
    <input class="input input--blue" type="text" name="ttl" placeholder="タイトル" value="{{ old('ttl') }}">
    <div class="file">
      <input class="file__input" type="file" name="img">
      <p class="file__btn">画像</p>
    </div>
    @error('body')
      <p class="error">{{ $message }}</p>
    @enderror
    <textarea class="textarea" name="body" placeholder="投稿内容">{{ old('body') }}</textarea>
    <div class="selects">
      <select class="select" name="grade">
        <option hidden value="0">学年</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select>
      <select class="select" name="class">
        <option hidden value="0">クラス</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select>
    </div>
    <label class="checkboxWrap"><input class="checkbox" type="checkbox">mailで送信</label>
    <input class="submit submit--blue" type="submit" value="投稿">
  </form>
@endsection