@extends('layouts.backLayout')
@section('content')
<form class="form form-margin-big" action="{{ route('representativeDetail') }}" method="post" enctype="multipart/form-data">
  @csrf
  <h2 class="from__headline">初回登録</h2>
  <input type="hidden" value="{{ $user_id }}" name="id">
  @error('jobs')
  <p class="error">{{ $message }}</p>
  @enderror
  <input class="input input--blue" type="text" placeholder="役職" name="jobs" value{{ old('jobs') }}>
  <div class="gradeClass">
    <div>
      @error('grade')
        <p class="error">{{ $message }}</p>
      @enderror
      <input class="gradeClass__input" type="text" name="grade" placeholder="学年" value="{{ old('grade') }}">
    </div>
    <div>
      @error('class')
        <p class="error">{{ $message }}</p>
      @enderror
      <input class="gradeClass__input" type="text" name="class" placeholder="クラス" value="{{ old('class') }}">
    </div>
  </div>
  <div class="file">
    <input class="file__input" type="file" name="imgPath" value="">
    <p class="file__btn">イメージを選択</p>
  </div>
  @error('introduction')
    <p class="error">{{ $message }}</p>
  @enderror
  <textarea class="textarea" name="introduction" placeholder="自己紹介">{{ old('introduction') }}</textarea>
  <input class="submit submit--blue" type="submit" value="登録">
</form>
@endsection