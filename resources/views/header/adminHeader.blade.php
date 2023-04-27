<header class="header">
  <h1 class="header__logo">Schmee</h1>
  <a class="header__register" href="{{ route('adminRegister') }}">
    <div>
      <span class="header__ver"></span>
      <span class="header__hor"></span>
    </div>
  </a>
  <a class="header__logout" href="{{ route('logout') }}"><i class="fa-solid fa-door-open header__logout-icon"></i></a>
</header>