@include('head.head')
@include('header.backHeader')

@yield('content')
<nav class="nav">
  <ul class="nav__list">
    <li class="nav__list-item"><a class="nav__list-link" href="{{ route('admin') }}"><i class="fa-solid fa-rectangle-list"></i></a></li>
  </ul>
</nav>
@include('footer')