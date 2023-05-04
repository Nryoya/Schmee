@extends('layouts.userBackLayout')
@section('content')
<section class="articles articles-margin">
  @if($articles->isEmpty())
  <p class="error">検索結果がありませんでした。</p>
  @endif
  @if (Auth::user()->role == 0)
    @foreach ($articles as $article)
        <article class="article">
          <div class="article__wrap">
            <div class="article__user">
              <a class="article__user-link" href="@if (Auth::user()->id == $article->users->id){{ route('mypage', Auth::user()->id) }}@else{{ route('user', $article->users_id) }}@endif">
              <img class="article__user-img" src="{{ Storage::url($article->users->teachers_detail->imgPath) }}"></a>
            </div>
            <a class="article__link" href="{{ route('articleDetail', $article->id) }}">
              <div class="article__head">
                <p>{{ $article->users->name }}</p>
                <time class="article__head-time">{{ $article->created_at }}</time>
              </div>
              <div class="article__body">
                @if ($article->articleImg)
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
              <p class="article__bottom-txt">コメント:{{ $article->comments->where('del_fg', 0)->count() }}</p>
              <p class="article__bottom-txt" >いいね:<span class="like_count">{{ $article->likes()->count() }}</span></p>
            </div>
          </div>
          <div class="article__bottom">
            <div class="article__bottom-inner">
              <a class="article__bottom-link" href="{{ route('articleDetail', $article->id) }}">
                <i class="fa-regular fa-comment article__bottom-icon"></i>
              </a>
              <div class="article__bottom-link like">
                @csrf
                <input type="hidden" name="articles_id" value="{{ $article->id }}" class="article_id">
                  <i class="fa-regular fa-star borderStar"></i>
                  <i class="{{ $article->isLikeBy(Auth::user()->id) ? 'fa-solid fa-star star active' : 'fa-solid fa-star star' }}"></i>  
              </div>
            </div>
          </div>
        </article>
    @endforeach 
  @else
    @foreach ($articles as $article)
      <article class="article">
        <div class="article__wrap">
          <div class="article__user">
            <a class="article__user-link" href="
              @if (Auth::user()->id == $article->users->id)
                {{ route('mypage', Auth::user()->id) }}
              @else
                {{ route('user', $article->users_id) }}
              @endif
            ">
            <img class="article__user-img" src="{{ Storage::url($article->users->teachers_detail->imgPath) }}"></a>
          </div>
          <a class="article__link" href="{{ route('articleDetail', $article->id) }}">
            <div class="article__head">
              <p>{{ $article->users->name }}</p>
              <time class="article__head-time">{{ $article->created_at }}</time>
            </div>
            <div class="article__body">
              @if ($article->articleImg)
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
            <p class="article__bottom-txt">コメント:{{ $article->comments->where('del_fg', 0)->count() }}</p>
            <p class="article__bottom-txt" >いいね:<span class="like_count">{{ $article->likes()->count('articles_id', $article->id) }}</span></p>
          </div>
        </div>
        <div class="article__bottom">
          <div class="article__bottom-inner">
            <a class="article__bottom-link" href="{{ route('articleDetail', $article->id) }}">
              <i class="fa-regular fa-comment article__bottom-icon"></i>
            </a>
            <div class="article__bottom-link like">
              @csrf
              <input type="hidden" name="articles_id" value="{{ $article->id }}" class="article_id">
                <i class="fa-regular fa-star borderStar"></i>
                <i class="{{ $article->isLikeBy(Auth::user()->id) ? 'fa-solid fa-star star active' : 'fa-solid fa-star star' }}"></i>
            </div>
          </div>
        </div>
      </article>
    @endforeach 
  @endif
</section>
@endsection