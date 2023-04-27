@extends('layouts.adminLayout')
@section('content')
<form class="search" action="#" method="POST">
  <div class="search__wrap">
    <input class="search__input" name="" type="text" placeholder="学校検索">
    <button class="search__iconWrap"><i class="fa-solid fa-magnifying-glass search__icon"></i></button>
  </div>
</form>
  <section class="schoolLists">
    @foreach ($schools as $school)
      <a class="schoolLists__item" href="{{ route('adminSchoolDetail', $school['id']) }}">
        <div class="schoolLists__wrap">
          <p class="schoolLists__name">{{ $school['name'] }}</p>
          <p class="schoolLists__representative">{{ $school['representative'] }}</p>
        </div>
      </a>
    @endforeach
  </section>
@endsection