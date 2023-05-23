<header class="header">
  <section class="talk-header">
    <div class="talk-header__wrap">
      @if ($person->role == 0)
        <p class="talk-header__name">{{ $person->users_detail->grade }}年{{ $person->users_detail->class }}組 {{ $person->name }}</p>
      @else
        <p class="talk-header__name">{{ $person->name }}先生</p>
      @endif
    </div>
  </section>
  <a class="header__back" href="{{ route('messageList') }}"><i class="fa-solid fa-chevron-left header__back-icon"></i></a>
</header>