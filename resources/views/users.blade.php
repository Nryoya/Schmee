@extends('layouts.topLayout')
@section('content')
<form class="search" action="{{ route('search_result_user') }}" method="GET">
  <div class="search__wrap">
    <input class="search__input" type="search" name="search" placeholder="ユーザー検索">
    <button class="search__iconWrap"><i class="fa-solid fa-magnifying-glass search__icon"></i></button>
  </div>
</form>
<section class="users">
  @if (Auth::user()->role == 0)
    @foreach ($users as $user)
      @if ($user->teachers_detail)
        <a class="users__list" href="{{ route('user', $user->id) }}">
          <div class="users__list-imgWrap">
            <img class="users__list-img" src="{{ Storage::url($user->teachers_detail->imgPath) }}">
          </div>
          <div class="users__list-detail">
            @if ($user->teachers_detail->jobs == '担任')
            <p class="users__list-gradeClass">{{ $user->teachers_detail->grade }}年{{ $user->teachers_detail->class }}組 {{ $user->teachers_detail->jobs }}</p>
            @else
            <p class="users__list-gradeClass">{{ $user->teachers_detail->jobs }}</p>
            @endif
            <p class="users__list-name">{{ $user->name }} 先生</p>
          </div>
        </a>   
      @endif
    @endforeach
  @else
    @foreach ($users as $user)
      @if ($user->users_detail)
        <a class="users__list" href="{{ route('user', $user->id) }}">
          <div class="users__list-imgWrap">
            <img class="users__list-img" src="{{ Storage::url($user->users_detail->imgPath) }}">
          </div>
          <div class="users__list-detail">
            <p class="users__list-gradeClass">{{ $user->users_detail->grade }}年 {{ $user->users_detail->class }}組</p>
            <p class="users__list-name">{{ $user->name }}</p>
          </div>
        </a>   
      @endif
    @endforeach
  @endif
</section>
@endsection