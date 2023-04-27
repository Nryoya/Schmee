@extends('layouts.backLayout')
@section('content')
  <form class="search" action="#" method="POST">
    <div class="search__wrap">
      <input class="search__input" type="text" name="" placeholder="学校通信検索">
      <button class="search__iconWrap"><i class="fa-solid fa-magnifying-glass search__icon"></i></button>
    </div>
  </form>
  <section class="articles">
      @foreach ($articles as $article)
      <article class="article">
        <div class="article__wrap">
          <div class="article__user">
            <a class="article__user-link" href="{{ route('adminTeacherDetail', $article->users_id) }}"><img class="article__user-img" src="{{ Storage::url($article->imgPath) }}" alt=""></a>
          </div>
          <a class="article__link" href="{{ route('adminArticleDetail', $article->id) }}">
            <div class="article__head">
              <p>{{ $article->name }}</p>
              <time class="article__head-time">{{ $article->created_at }}</time>
            </div>
            <div class="article__body">
              @if($article->articleImg)
                <div class="article__body-imgWrap">
                  <img class="article__body-img" src="{{ Storage::url($article->articleImg) }}" alt="">
                </div>
              @endif
              <h2>{{ $article->title }}</h2>
              <p class="article__body-txt">{!! nl2br(htmlspecialchars($article->body)) !!}</p>
            </div>
          </a>
        </div>
        <div class="article__bottom">
          <div class="article__bottom-inner">
            <span class="article__bottom-txt">コメント:1</span>
            <span class="article__bottom-txt">いいね:4</span>
          </div>
        </div>  
      </article>
      @endforeach 
  </section>
@endsection