@extends('layouts.userBackLayout')
@section('content')
  <section class="user">
      <div class="user__head">
        <div class="user__head-imgWrap">
          <img class="user__head-img" src="{{ Storage::url($teacher_detail[0]->imgPath) }}" alt="">
        </div>
        <a class="user__head-update" href="#"><i class="fa-solid fa-envelope"></i></a>
      </div>
      <div class="user__detail">
        <div class="user__detail-head">
          <p class="user__detail-name">{{ $teacher_detail[0]->name }}</p>
          <p class="user__detail-onething">{{ $teacher_detail[0]->introduction }}</p>
        </div>
        <div class="user__detail-rows">
          <dt class="user__detail-ttl">役職</dt>
          <dd class="user__detail-datum">{{ $teacher_detail[0]->jobs }}</dd>
        </div>
        <dl class="user__detail-data">
          <div class="user__detail-rows">
            <dt class="user__detail-ttl">学年</dt>
            <dd class="user__detail-datum">{{ $teacher_detail[0]->grade }}年</dd>
          </div>
          <div class="user__detail-rows">
            <dt class="user__detail-ttl">クラス</dt>
            <dd class="user__detail-datum">{{ $teacher_detail[0]->class }}組</dd>
          </div>
        </dl>
      </div>
      
  </section>
@endsection