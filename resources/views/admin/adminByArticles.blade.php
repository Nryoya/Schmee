@extends('layouts.backLayout')
@section('content')
  @if ($articles->isEmpty())
  {{-- 投稿がない時 --}}
    <p class="error">投稿はありません</p>
  @else
  {{-- 投稿がある時 --}}
    <form class="search" action="{{ route('adminSearchArticle') }}" method="GET">
      <div class="search__wrap">
        <input type="hidden" name="school_id" value="{{ $articles[0]->schools_id }}">
        <input class="search__input" type="text" name="search" placeholder="学校通信検索">
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
              {{-- 学校通信に画像がある時 --}}
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
            <span class="article__bottom-txt">コメント:{{ $article->comments->count() }}</span>
            <span class="article__bottom-txt">いいね:{{ $article->likes->count() }}</span>
          </div>
        </div>  
      </article>
      @endforeach 
    </section>
  @endif
@endsection