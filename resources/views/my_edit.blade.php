@extends('layouts.userBackLayout')
@section('content')
  @if(Auth::user()->role == 0)
    <form class="form form-margin-big" action="{{ route('myDetailUpdate') }}" method="post" enctype="multipart/form-data">
      @method('PATCH')
      @csrf
      <h2 class="from__headline">編集</h2>
      <input type="hidden" value="{{ Auth::user()->id }}" name="id">
      <input class="input input--blue input--margin-top" type="text" placeholder="名前" name="name" value="{{ old('name', $detail->users->name) }}">
      <input class="input input--blue input--margin-top" type="text" placeholder="メールアドレス" name="email" value="{{ old('email', $detail->users->email) }}">
      <div class="gradeClass">
        <div>
          @error('grade')
            <p class="error">{{ $message }}</p>
          @enderror
          <input class="gradeClass__input" type="text" name="grade" placeholder="学年" value="{{ old('grade', $detail->grade) }}">
        </div>
        <div>
          @error('class')
            <p class="error">{{ $message }}</p>
          @enderror
          <input class="gradeClass__input" type="text" name="class" placeholder="クラス" value="{{ old('class', $detail->class) }}">
        </div>
      </div>
      @error('onething')
        <p class="error">{{ $message }}</p>
      @enderror
      <input class="input input--blue" type="text" name="onething" placeholder="ひとこと" value="{{ old('onething', $detail->onething) }}">
      <div class="file">
        <input class="file__input" type="file" name="imgPath">
        <p class="file__btn">{{ old('imgPath', "イメージを選択") }}</p>
      </div>
      @error('tel')
        <p class="error">{{ $message }}</p>
      @enderror
      <input class="input input--blue" type="tel" name="tel" placeholder="電話番号" value="{{ old('tel', $detail->tel) }}">
      @error('address')
        <p class="error">{{ $message }}</p>
      @enderror
      <input class="input input--blue" type="text" name="address" placeholder="住所" value="{{ old('address', $detail->address) }}">
      @error('emergency')
        <p class="error">{{ $message }}</p>
      @enderror
      <input class="input input--blue" type="tel" name="emergency" placeholder="緊急連絡先" value="{{ old('emergency', $detail->emergency) }}">
      @error('relationship')
        <p class="error">{{ $message }}</p>
      @enderror
      <input class="input input--blue" type="text" name="relationship" placeholder="続柄" value="{{ old('relationship', $detail->relationship) }}">
      <input class="submit submit--blue" type="submit" value="編集">
    </form>
  @else
    <form class="form form-margin-big" action="{{ route('myDetailUpdate') }}" method="post" enctype="multipart/form-data">
      @method('PATCH')
      @csrf
      <h2 class="from__headline">編集</h2>
      <input type="hidden" value="{{ Auth::user()->id }}" name="id">
      <input class="input input--blue input--margin-top" type="text" placeholder="名前" name="name" value="{{ old('name', $detail->users->name) }}">
      <input class="input input--blue input--margin-top" type="text" placeholder="メールアドレス" name="email" value="{{ old('email', $detail->users->email) }}">
      <input class="input input--blue input--margin-top" type="text" placeholder="役職" name="jobs" value="{{ old('jobs', $detail->jobs) }}">
      <div class="gradeClass">
        <div>
          @error('grade')
            <p class="error">{{ $message }}</p>
          @enderror
          <input class="gradeClass__input" type="text" name="grade" placeholder="学年" value="{{ old('grade', $detail->grade) }}">
        </div>
        <div>
          @error('class')
            <p class="error">{{ $message }}</p>
          @enderror
          <input class="gradeClass__input" type="text" name="class" placeholder="クラス" value="{{ old('class', $detail->class) }}">
        </div>
      </div>
      <div class="file">
        <input class="file__input" type="file" name="imgPath">
        <p class="file__btn">{{ old('imgPath', "イメージを選択") }}</p>
      </div>
      @error('introduction')
        <p class="error">{{ $message }}</p>
      @enderror
      <textarea class="textarea" name="introduction" placeholder="自己紹介">{{ old('introduction', $detail->introduction) }}</textarea>
      <input class="submit submit--blue" type="submit" value="編集">
    </form>
  @endif
@endsection