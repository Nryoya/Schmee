@extends('layouts.userBackLayout')
@section('content')
<section class="articleDetail">
  <article class="article">
    <div class="article__wrap">
      <div class="article__user">
        <a class="article__user-link" href="@if (Auth::user()->id == $articles->users->id){{ route('mypage', Auth::user()->id) }}@else{{ route('user', $articles->users_id) }}@endif">
        <img class="article__user-img" src="{{ Storage::url($articles->users->teachers_detail->imgPath) }}" alt=""></a>
      </div>
      <div class="article__link">
        <div class="article__head">
          <p>{{ $articles->users->name }}</p>
          @if (Auth::user()->id == $articles->users->id)
            <div class="menu">
              <i class="fa-solid fa-ellipsis menu__btn"></i>
              <div class="menu__links">
                <a class="menu__link" href="{{ route('updateDelFg', $articles->id) }}">削除</a>
              </div>
            </div>
          @endif
        </div>
        <div class="article__body">
          @if ($articles->articleImg)
            <div class="article__body-imgWrap">
              <img class="article__body-img" src="{{ Storage::url($articles->articleImg) }}">
            </div>
          @endif
          <h2 class="article__body-title">{{ $articles->title }}</h2>
          <p  class="article__body-txt">{!! nl2br(htmlspecialchars($articles->body)) !!}</p>
        </div>
        <time class="article__time">{{ $articles->created_at }}</time>
      </div>
    </div>
    <div class="article__bottom">
      <div class="article__bottom-inner">
        <p class="article__bottom-txt">コメント:<span id="comment_count">{{ $articles->comments->where('del_fg', 0)->count() }}</span></p>
        <span class="article__bottom-txt">いいね:{{ $articles->likes()->count() }}</span>
      </div>
    </div>
  </article>
</section>
<section class="comment">
  <div class="comment__inner" id="comment__inner">
    @foreach ($comments as $comment)
      @if ($comment->del_fg == 0)
        <div class="comment__comments">
          <div class="article__user">
            <div class="article__user-link"><img class="article__user-img" src="@if ($comment->users->users_detail){{ Storage::url($comment->users->users_detail->imgPath) }}@else{{ Storage::url($comment->users->teachers_detail->imgPath) }}@endif"></div>
          </div>
          <div class="comment__body">
            <div class="comment__body-head">
              <p class="comment__user">{{ $comment->users->name }}</p>
              <time class="comment__time">{{ $comment->created_at }}</time>
            </div>
            <p class="comment__body-message">{!! nl2br(htmlspecialchars($comment->body)) !!}</p>
          </div>
          @if (Auth::user()->id == $comment->users_id)
            <div class="comment__delete">
              @csrf
              <input type="hidden" name="comments_id" value="{{ $comment->id }}" class="comment__delete-input">
              <i class="fa-solid fa-trash-can trash"></i>
            </div>
          @endif
        </div>
      @endif
    @endforeach
  </div>
</section>
<div class="message">
  <div class="message__wrap">
    @csrf
    <input type="hidden" name="articles_id" value="{{ $articles->id }}" id="articles_id">
    <input type="hidden" name="users_id" value="{{ Auth::user()->id }}" id="users_id">
    <textarea class="message__txt" name="body" placeholder="コメント" id="body"></textarea>
    <button class="message__iconWrap" id="comment"><i class="fa-solid fa-paper-plane comment__icon"></i></button>
  </div>
</div>
@endsection