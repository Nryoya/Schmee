@extends('layouts.backLayout')
@section('content')
  <section class="articleDetail">
    <article class="article">
      <div class="article__wrap">
        <div class="article__user">
          <a class="article__user-link" href="{{ route('adminTeacherDetail', $detail[0]->users_id) }}"><img class="article__user-img" src="{{ Storage::url($detail[0]->imgPath) }}" alt=""></a>
        </div>
        <div class="article__link">
          <div class="article__head">
            <p>{{ $detail[0]->name }}</p>
            <div class="menu">
              <i class="fa-solid fa-ellipsis menu__btn"></i>
              <div class="menu__links">
                <a class="menu__link" href="#">削除</a>
              </div>
            </div>
          </div>
          <div class="article__body">
            @if($detail[0]->articleImg)
              <div class="article__body-imgWrap">
                <img class="article__body-img" src="{{ storage::url($detail[0]->articleImg) }}" alt="">
              </div>
              @endif
            <h2>{{ $detail[0]->title }}</h2>
            <p>{!! nl2br(htmlspecialchars($detail[0]->body)) !!}</p>
          </div>
          <time class="article__time">{{ $detail[0]->created_at }}</time>
        </div>
      </div>
      <div class="article__bottom">
        <div class="article__bottom-inner">
          <span class="article__bottom-txt">コメント:1</span>
          <span class="article__bottom-txt">いいね:4</span>
        </div>
      </div>
    </article>
  </section>
@endsection