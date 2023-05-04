<header class="header">
  <h1 class="header__logo">Schmee</h1>
  <a class="header__back" href="{{ route('articles') }}"><i class="fa-solid fa-chevron-left header__back-icon"></i></a>
  <form class="header__logout--right" id="logout" action="{{ route('logout') }}">
    @csrf
    <i class="fa-solid fa-door-open header__logout-icon" id="icon"></i>
    <button class="header__logout-btn" id="btn" onclick="return check_logout()"></button>
  </form>
</header>