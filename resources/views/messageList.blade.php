@extends('layouts.userBackLayout')
@section('content')
  <section class="messageList">
      <a class="newGroup__link" href="#">
        <p>グループ作成</p>
        <div class="newGroup__plus">
          <div>
            <span class="newGroup__ver"></span>
            <span class="newGroup__hor"></span>
          </div>
        </div>
      </a>
    <section class="users">
      <a class="users__list" href="{{ route('message') }}">
        <div class="users__list-imgWrap">
          
        </div>
        <div class="users__list-detail">
          <p class="users__list-gradeClass">3年 1組</p>
          <p class="users__list-name">西面  遼哉</p>
        </div>
      </a>
    </section>
  </section>
@endsection