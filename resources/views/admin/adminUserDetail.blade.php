@extends('layouts.backLayout')
@section('content')
  <section class="user">
    <div class="user__head">
      <div class="user__head-imgWrap">
        <img class="user__head-img" src="{{ Storage::url($user_detail[0]->imgPath) }}" alt="">
      </div>
      <a class="user__head-delete" href="#">削除</a>
    </div>
    <div class="user__detail">
      <div class="user__detail-head">
        <p class="user__detail-name">{{ $user_detail[0]->name }}</p>
        <p class="user__detail-onething">{{ $user_detail[0]->onething }}</p>
      </div>
      <dl class="user__detail-data">
        <div class="user__detail-rows">
          <dt class="user__detail-ttl">学年</dt>
          <dd class="user__detail-datum">{{ $user_detail[0]->grade }}年</dd>
        </div>
        <div class="user__detail-rows">
          <dt class="user__detail-ttl">クラス</dt>
          <dd class="user__detail-datum">{{ $user_detail[0]->class }}組</dd>
        </div>
      </dl>
      <div class="user__detail-rows">
        <dt class="user__detail-ttl">電話番号</dt>
        <dd class="user__detail-datum">{{ $user_detail[0]->tel }}</dd>
      </div>
      <div class="user__detail-rows">
        <dt class="user__detail-ttl">緊急連絡先</dt>
        <dd class="user__detail-datum">{{ $user_detail[0]->emergency }}</dd>
      </div>
      <div class="user__detail-rows">
        <dt class="user__detail-ttl">続柄</dt>
        <dd class="user__detail-datum">{{ $user_detail[0]->relationship }}</dd>
      </div>
    </div>
    <div class="user__detail-map"></div>
  </section>
@endsection