@extends('layouts.mypageLayout')
@section('content')
<section class="user">
  @if (Auth::user()->role == 0)
    <div class="user__head">
      <div class="user__head-imgWrap">
        <img class="user__head-img" src="{{ Storage::url($user->users_detail->imgPath) }}">
      </div>
      <a class="user__head-edit" href="{{ route('myEdit', [Auth::user()->role, Auth::user()->id]) }}">編集</a>
    </div>
    <div class="user__detail">
      <div class="user__detail-head">
        <p class="user__detail-name">{{ $user->name }}</p>
        <p class="user__detail-onething">{{ $user->users_detail->onething }}</p>
      </div>
      <dl class="user__detail-data">
        <div class="user__detail-rows">
          <dt class="user__detail-ttl">学年</dt>
          <dd class="user__detail-datum">{{ $user->users_detail->grade }}年</dd>
        </div>
        <div class="user__detail-rows">
          <dt class="user__detail-ttl">クラス</dt>
          <dd class="user__detail-datum">{{ $user->users_detail->class }}組</dd>
        </div>
        <div class="user__detail-rows">
          <dt class="user__detail-ttl">電話番号</dt>
          <dd class="user__detail-datum">{{ $user->users_detail->tel }}</dd>
        </div>
        <div class="user__detail-rows">
          <dt class="user__detail-ttl">緊急連絡先</dt>
          <dd class="user__detail-datum">{{ $user->users_detail->emergency }}</dd>
        </div>
        <div class="user__detail-rows">
          <dt class="user__detail-ttl">緊急連絡先続柄</dt>
          <dd class="user__detail-datum">{{ $user->users_detail->relationship }}</dd>
        </div>
      </dl>
      <div class="user__detail-map"></div>
    </div>
  @else
    <div class="user__head">
      <div class="user__head-imgWrap">
        <img class="user__head-img" src="{{ Storage::url($user->teachers_detail->imgPath) }}" alt="">
      </div>
      <a class="user__head-edit" href="{{ route('myEdit', [Auth::user()->role, Auth::user()->id]) }}">編集</a>
    </div>
    <div class="user__detail">
      <div class="user__detail-head">
        <p class="user__detail-name">{{ $user->name }}</p>
        <p class="user__detail-onething">{!! nl2br(htmlspecialchars($user->teachers_detail->introduction)) !!}</p>
      </div>
      <div class="user__detail-rows">
        <dt class="user__detail-ttl">役職</dt>
        <dd class="user__detail-datum">{{ $user->teachers_detail->jobs }}</dd>
      </div>
      <dl class="user__detail-data">
        <div class="user__detail-rows">
          <dt class="user__detail-ttl">学年</dt>
          <dd class="user__detail-datum">
            @if (!$user->teachers_detail->grade == 0)
              {{ $user->teachers_detail->grade }}年
            @endif
          </dd>
        </div>
        <div class="user__detail-rows">
          <dt class="user__detail-ttl">クラス</dt>
          <dd class="user__detail-datum">
            @if (!$user->teachers_detail->grade == 0)
              {{ $user->teachers_detail->class }}組
            @endif
          </dd>
        </div>
      </dl>
    </div>
  @endif
</section>
@endsection