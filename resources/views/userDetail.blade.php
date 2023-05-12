@extends('layouts.userBackLayout')
@section('content')
<section class="user">
  @if ($users->role != 0)
  <div class="user__head">
    <div class="user__head-imgWrap">
      <img class="user__head-img" src="{{ Storage::url($users->teachers_detail->imgPath) }}">
    </div>
    @if(Auth::user()->role == 0)
      <a class="user__head-edit" href="{{ route('room', [$users->id, $users->name]) }}"><i class="fa-solid fa-envelope"></i></a>
    @endif
  </div>
  <div class="user__detail">
    <div class="user__detail-head">
      <p class="user__detail-name">{{ $users->name }}</p>
      <p class="user__detail-onething">{!! nl2br(htmlspecialchars($users->teachers_detail->introduction)) !!}</p>
    </div>
    <dl class="user__detail-data">
      <div class="user__detail-rows">
        <dt class="user__detail-ttl">学校名</dt>
        <dd class="user__detail-datum">{{ $users->schools->name }}</dd>
      </div>
      <div class="user__detail-rows">
        <dt class="user__detail-ttl">役職</dt>
        <dd class="user__detail-datum">{{ $users->teachers_detail->jobs }}</dd>
      </div>
      <div class="user__detail-rows">
        <dt class="user__detail-ttl">学年</dt>
        <dd class="user__detail-datum">
          @if (!$users->teachers_detail->grade == 0)
            {{ $users->teachers_detail->grade }}
          @endif
        </dd>
      </div>
      <div class="user__detail-rows">
        <dt class="user__detail-ttl">クラス</dt>
        <dd class="user__detail-datum">
          @if (!$users->teachers_detail->class == 0)
            {{ $users->teachers_detail->class }}
          @endif
        </dd>
      </div>
    </dl>
  </div>
  @else
  <div class="user__head">
    <div class="user__head-imgWrap">
      <img class="user__head-img" src="{{ Storage::url($users->users_detail->imgPath) }}">
    </div>
    <a class="user__head-edit" href="{{ route('room', [$users->id, $users->name]) }}"><i class="fa-solid fa-envelope"></i></a>
  </div>
  <div class="user__detail">
    <div class="user__detail-head">
      <p class="user__detail-name">{{ $users->name }}</p>
      <p class="user__detail-onething">{!! nl2br(htmlspecialchars($users->users_detail->onething)) !!}</p>
    </div>
    <dl class="user__detail-data">
      <div class="user__detail-rows">
        <dt class="user__detail-ttl">学校名</dt>
        <dd class="user__detail-datum">{{ $users->schools->name }}</dd>
      </div>
      <div class="user__detail-rows">
        <dt class="user__detail-ttl">学年</dt>
        <dd class="user__detail-datum">{{ $users->users_detail->grade }}年</dd>
      </div>
      <div class="user__detail-rows">
        <dt class="user__detail-ttl">クラス</dt>
        <dd class="user__detail-datum">{{ $users->users_detail->class }}組</dd>
      </div>
      <div class="user__detail-rows">
        <dt class="user__detail-ttl">電話番号</dt>
        <dd class="user__detail-datum">{{ $users->users_detail->tel }}</dd>
      </div>
      <div class="user__detail-rows">
        <dt class="user__detail-ttl">緊急連絡先</dt>
        <dd class="user__detail-datum">{{ $users->users_detail->emergency }}</dd>
      </div>
      <div class="user__detail-rows">
        <dt class="user__detail-ttl">緊急連絡先続柄</dt>
        <dd class="user__detail-datum">{{ $users->users_detail->relationship }}</dd>
      </div>
    </dl>
    <div class="user__detail-map"></div>
  </div>
  @endif
</section>
@endsection