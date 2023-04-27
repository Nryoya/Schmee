@include('head.head')
@include('header.topHeader')

@yield('content')

@if (Auth::user()->role == 1 || Auth::user()->role == 2)
  @include('postIcon')
@endif
@include('nav')
@include('footer')