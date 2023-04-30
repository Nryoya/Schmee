@extends('layouts.userBackLayout')
@section('content')
  <section class="messageList">
    {{-- @if (!Auth::user()->role == 0)
      <a class="newGroup__link" href="#">
        <p>グループ作成</p>
        <div class="newGroup__plus">
          <div>
            <span class="newGroup__ver"></span>
            <span class="newGroup__hor"></span>
          </div>
        </div>
      </a>
    @endif --}}
    <section class="users">
      @foreach ($lists as $list)
        @if (Auth::user()->role == 0)
          <a class="users__list" href="{{ route('inRoom', [$list->pivot->room_id, $list->id]) }}">
            <div class="users__list-imgWrap">
              <img class="users__list-img" src="{{ Storage::url($list->teachers_detail->imgPath) }}">
            </div>
            <div class="users__list-detail">
              <p class="users__list-name">{{ $list->name }}</p>
            </div>
          </a>
        @else
          <a class="users__list" href="{{ route('inRoom', [$list->pivot->room_id, $list->id]) }}">
            <div class="users__list-imgWrap">
              <img class="users__list-img" src="{{ Storage::url($list->users_detail->imgPath) }}">
            </div>
            <div class="users__list-detail">
              <p class="users__list-name">{{ $list->name }}</p>
            </div>
          </a>
        @endif
      @endforeach
    </section>
  </section>
@endsection