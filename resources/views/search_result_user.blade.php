@extends('layouts.userBackLayout')
@section('content')
  <section class="users">
    @if (!$users)
      <p class="error">検索結果がありませんでした。</p>
    @endif
    @if (Auth::user()->role == 0)
      @foreach ($users as $user)
        @if ($user->teachers_detail)
          <a class="users__list" href="{{ route('user', $user->id) }}">
            <div class="users__list-imgWrap">
              <img class="users__list-img" src="{{ Storage::url($user->teachers_detail->imgPath) }}">
            </div>
            <div class="users__list-detail">
              <p class="users__list-gradeClass">{{ $user->teachers_detail->jobs }}</p>
              <p class="users__list-name">{{ $user->name }}</p>
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