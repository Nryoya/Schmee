@extends('layouts.backLayout')
@section('content')
  <section class="articleDetail">
    <article class="article">
      <div class="article__wrap">
        <div class="article__user">
          <a class="article__user-link" href="{{ route('adminTeacherDetail', $article->users_id) }}"><img class="article__user-img" src="{{ Storage::url($article->users->teachers_detail->imgPath) }}" alt=""></a>
        </div>
        <div class="article__link">
          <div class="article__head">
            <p>{{ $article->users->name }}</p>
          </div>
          <div class="article__body">
            @if($article->articleImg)
              <div class="article__body-imgWrap">
                <img class="article__body-img" src="{{ storage::url($article->articleImg) }}" alt="">
              </div>
              @endif
            <h2>{{ $article->title }}</h2>
            <p>{!! nl2br(htmlspecialchars($article->body)) !!}</p>
          </div>
          <time class="article__time">{{ $article->created_at }}</time>
        </div>
      </div>
      <div class="article__bottom">
        <div class="article__bottom-inner">
          <span class="article__bottom-txt">コメント:{{ $article->comments->count() }}</span>
          <span class="article__bottom-txt">いいね:{{ $article->likes->count() }}</span>
        </div>
      </div>
    </article>
  </section>
  <section class="comment">
    <div class="comment__inner" id="comment__inner">
      @foreach ($article->comments as $comment)
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
      @endforeach
    </div>
  </section>
@endsection