<header class="header">
  <h1 class="header__logo">Schmee</h1>
  <a class="header__user" href="{{ route('mypage', Auth::user()->id) }}">
    @if (Auth::user()->role == 0)
      <img class="header__user-img" src="{{ Storage::url(Auth::user()->users_detail->imgPath) }}">
    @else
      <img class="header__user-img" src="{{ Storage::url(Auth::user()->teachers_detail->imgPath) }}">
    @endif
  </a>
</header>