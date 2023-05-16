@extends('layouts.topLayout')
@section('content')
  <section class="messageList">
    <section class="users">
      @foreach ($lists as $list)
        @if (Auth::user()->role == 0)
          <a class="users__list" href="{{ route('inRoom', [$list->pivot->room_id, $list->id]) }}">
            <div class="users__list-imgWrap">
              <img class="users__list-img" src="{{ Storage::url($list->teachers_detail->imgPath) }}">
            </div>
            <div class="users__list-detail">
              <div class="users__list-job">
                @if ($list->teachers_detail->jobs == '担任')
                  <p>{{ $list->teachers_detail->grade }}年{{ $list->teachers_detail->class }}組 {{ $list->teachers_detail->jobs }}</p>
                @else
                <p>{{ $list->teachers_detail->jobs }}</p>  
                @endif
              </div>
              <p class="users__list-name">{{ $list->name }} 先生</p>
            </div>
          </a>
        @else
          <a class="users__list" href="{{ route('inRoom', [$list->pivot->room_id, $list->id]) }}">
            <div class="users__list-imgWrap">
              <img class="users__list-img" src="{{ Storage::url($list->users_detail->imgPath) }}">
            </div>
            <div class="users__list-detail">
              <p>{{ $list->users_detail->grade }}年{{ $list->users_detail->class }}組</p>
              <p class="users__list-name">{{ $list->name }}</p>
            </div>
          </a>
        @endif
      @endforeach
    </section>
  </section>
@endsection