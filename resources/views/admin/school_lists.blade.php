@extends('layouts.adminLayout')
@section('content')
  <form class="search" action="{{ route('searchSchool') }}" method="GET">
    <div class="search__wrap">
      <input class="search__input" name="search" type="search" placeholder="学校検索">
      <button class="search__iconWrap"><i class="fa-solid fa-magnifying-glass search__icon"></i></button>
    </div>
  </form>
  <section class="schoolLists">
    @foreach ($representatives as $representative)
      <a class="schoolLists__item" href="{{ route('schoolDetail', $representative->schools_id) }}">
        <div class="schoolLists__wrap">
          <p class="schoolLists__name">{{ $representative->schools->name }}</p>
          <p class="schoolLists__representative">{{ $representative->name }}</p>
        </div>
      </a>
    @endforeach
  </section>
@endsection