@extends('layouts.topLayout')
@section('content')
<form class="search" action="{{ route('searchResultArticle') }}" method="GET">
  <div class="search__wrap">
    <input class="search__input" type="text" name="search" placeholder="学校通信検索">
    <button class="search__iconWrap"><i class="fa-solid fa-magnifying-glass search__icon"></i></button>
  </div>
</form>
@endsection