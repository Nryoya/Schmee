@extends('layouts.backLayout')
@section('content')
<form class="search" action="{{ route('adminSearchUser') }}" method="GET">
  <div class="search__wrap">
    <input type="hidden" name="school_id" value="{{ $id }}">
    <input class="search__input" type="text" name="search" placeholder="ユーザー検索">
    <button class="search__iconWrap"><i class="fa-solid fa-magnifying-glass search__icon"></i></button>
  </div>
</form>
<section class="users">
  <p class="users__classification">学校関係者</p>
  @foreach ($teachers as $teacher)
  <a class="users__list" href="{{ route('adminTeacherDetail', $teacher['id']) }}">
    <div class="users__list-imgWrap">
      <img class="users__list-img" src="{{ Storage::url($teacher->imgPath) }}" alt="">
    </div>
    <div class="users__list-detail">
      <p class="users__list-gradeClass">{{ $teacher['jobs'] }}</p>
      <p class="users__list-name">{{ $teacher['name'] }}</p>
    </div>
  </a>
  @endforeach
  <p class="users__classification">保護者</p>
  @foreach ($users as $user)
  <a class="users__list" href="{{ route('adminUserDetail', $user['id']) }}">
    <div class="users__list-imgWrap">
      <img class="users__list-img" src="{{ Storage::url($user->imgPath) }}" alt="">
    </div>
    <div class="users__list-detail">
      <p class="users__list-gradeClass">{{ $user['grade'] }}年 {{ $user['class'] }}組</p>
      <p class="users__list-name">{{ $user['name'] }}</p>
    </div>
  </a>
  @endforeach
</section>
@endsection