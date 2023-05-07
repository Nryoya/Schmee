@extends('layouts.backLayout')
@section('content')

  <section class="schoolLists">
    @if($users->isEmpty())
      <p class="error">検索結果がありません。</p>
    @endif
    @foreach ($users as $user)
      @if ($user->role == 0)
      {{-- 検索結果が保護者の時 --}}
        <a class="users__list" href="{{ route('adminUserDetail', $user->id) }}">
          <div class="users__list-imgWrap">
            <img class="users__list-img" src="{{ Storage::url($user->users_detail->imgPath) }}">
          </div>
          <div class="users__list-detail">
            <p class="users__list-gradeClass">{{ $user->users_detail->grade }}年 {{ $user->users_detail->class }}組</p>
            <p class="users__list-name">{{ $user->name }}</p>
          </div>
      </a>
      @else
      {{-- 検索結果が関係者の時 --}}
        <a class="users__list" href="{{ route('adminTeacherDetail', $user->id) }}">
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
  </section>
@endsection