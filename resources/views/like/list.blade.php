@extends('layouts.userBackLayout')
@section('content')
    <section class="users">
        @foreach ($like_users as $like_user)
          @if ($like_user->users->users_detail)
          <div class="users__list">
            <div class="users__list-imgWrap">
              <img class="users__list-img" src="{{ Storage::url($like_user->users->users_detail->imgPath) }}">
            </div>
            <div class="users__list-detail">
              <p class="users__list-gradeClass">{{ $like_user->users->users_detail->grade }}年 {{ $like_user->users->users_detail->class }}組</p>
              <p class="users__list-name">{{ $like_user->users->name }}</p>
            </div>
          </div>
          @else
          <div class="users__list">
            <div class="users__list-imgWrap">
              <img class="users__list-img" src="{{ Storage::url($like_user->users->teachers_detail->imgPath) }}">
            </div>
            <div class="users__list-detail">
              @if ($like_user->users->teachers_detail->jobs == '担任')
              <p class="users__list-gradeClass">{{ $like_user->users->teachers_detail->grade }}年{{ $like_user->users->teachers_detail->class }}組 {{ $like_user->users->teachers_detail->jobs }}</p>
              @else
              <p class="users__list-gradeClass">{{ $like_user->users->teachers_detail->jobs }}</p>
              @endif
              <p class="users__list-name">{{ $like_user->users->name }} 先生</p>
            </div>
          </div>   
          @endif
        @endforeach
    </section>
@endsection