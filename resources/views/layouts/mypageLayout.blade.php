@include('head.head')
@include('header.mypageHeader')

@yield('content')

@if (Auth::user()->role == 1 || Auth::user()->role == 2)
  @include('postIcon')
@endif
@include('nav')
@include('footer')