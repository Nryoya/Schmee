@extends('layouts.firstLayout')
@section('content')
<a href="{{ route('logout') }}">ログアウト</a>
  <form class="form form-margin-big" action="{{ route('userDetail') }}" method="post" enctype="multipart/form-data">
    @csrf
    <h2 class="from__headline">初回登録</h2>
    <input type="hidden" value="{{ Auth::user()->id }}" name="id">
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
    @error('onething')
      <p class="error">{{ $message }}</p>
    @enderror
    <input class="input input--blue" type="text" name="onething" placeholder="ひとこと" value="{{ old('onething') }}">
    <div class="file">
      <input class="file__input" type="file" name="imgPath" value="">
      <p class="file__btn">イメージを選択</p>
    </div>
    @error('tel')
      <p class="error">{{ $message }}</p>
    @enderror
    <input class="input input--blue" type="tel" name="tel" placeholder="電話番号" value="{{ old('tel') }}">
    @error('address')
      <p class="error">{{ $message }}</p>
    @enderror
    <input class="input input--blue" type="text" name="address" placeholder="住所" value="{{ old('address') }}">
    @error('emergency')
      <p class="error">{{ $message }}</p>
    @enderror
    <input class="input input--blue" type="tel" name="emergency" placeholder="緊急連絡先" value="{{ old('emergencyTel') }}">
    @error('relationship')
      <p class="error">{{ $message }}</p>
    @enderror
    <input class="input input--blue" type="text" name="relationship" placeholder="続柄" value="{{ old('relationship') }}">
    <input class="submit submit--blue" type="submit" value="登録">
  </form>
@endsection