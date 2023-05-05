@extends('layouts.backLayout')
@section('content')
  <section class="schoolLists">
    @if($schools->isEmpty())
      <p class="error">検索結果がありません。</p>
    @endif
    @foreach ($schools as $school)
      <a class="schoolLists__item" href="{{ route('schoolDetail', $school['id']) }}">
        <div class="schoolLists__wrap">
          <p class="schoolLists__name">{{ $school->name }}</p>
        </div>
      </a>
    @endforeach
  </section>
@endsection