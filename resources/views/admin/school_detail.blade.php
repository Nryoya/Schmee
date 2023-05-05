@extends('layouts.backLayout')
@section('content')
  <section class="schoolDetails">
    <section>
      <div class="schoolDetails__school">
        <h2>学校名</h2>
        <div class="menu">
          <i class="fa-solid fa-ellipsis menu__btn"></i>
          <div class="menu__links">
            <a class="menu__link" href="{{ route('schoolUpdateShow', $representative->schools->id) }}">学校編集</a>
            <a class="menu__link" href="{{ route('schoolDelete', $representative->schools->id) }}">削除</a>
          </div>
        </div>
      </div>
      <ul class="schoolDetails__school-items">
        <li class="schoolDetails__school-item">{{ $representative->schools->code }}</li>
        <li class="schoolDetails__school-item">{{ $representative->schools->name }}</li>
        <li class="schoolDetails__school-item">{{ $representative->schools->address }}</li>
        <li class="schoolDetails__school-item">{{ $representative->schools->tel }}</li>
      </ul>
    </section>
    <section class="schoolDetails__wrap">
      <h2>代表者名</h2>
      <ul class="schoolDetails__school-items">
        <li class="schoolDetails__school-item">{{ $representative->name }}</li>
        <li class="schoolDetails__school-item">{{ $representative->email }}</li>
      </ul>
    </section>
    <section class="schoolDetails__wrap">
      <ul class="schoolDetails__links-lists">
        <li class="schoolDetails__links-list"><a class="schoolDetails__links-link" href="{{ route('adminBySchoolUsers', $representative->schools->id) }}">ユーザー一覧</a></li>
        <li class="schoolDetails__links-list"><a class="schoolDetails__links-link" href="{{ route('adminByArticles', $representative->schools->id) }}">投稿一覧</a></li>
      </ul>
    </section>
  </section>
@endsection