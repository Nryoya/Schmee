@extends('layouts.messageLayout')
@section('content')
  <section class="talk">
    <div class="talk__wrap">
      @if (Auth::user()->role == 0)
        @foreach ($result as $message)
          @if($message->users_id != Auth::user()->id)
            <div class="talk__userWrap">
              <div class="talk__user">
                <img class="talk__user-img" src="{{ Storage::url($message->users->teachers_detail->imgPath) }}">
              </div>
              <div class="talk__body">
                <p class="talk__name">{{ $message->users->name }}</p>
                <p class="talk__message">{!! nl2br(htmlspecialchars($message->message)) !!}</p>
              </div>
            </div>
          @else
            <div class="talk__userWrap--reverse">
              <div class="talk__body--reverse">
                <p class="talk__message--reverse">{!! nl2br(htmlspecialchars($message->message)) !!}</p>
              </div>
            </div>
          @endif
        @endforeach
      @else
        @foreach ($result as $message)
          @if($message->users_id != Auth::user()->id)
            <div class="talk__userWrap">
              <div class="talk__user">
                <img class="talk__user-img" src="{{ Storage::url($message->users->users_detail->imgPath) }}">
              </div>
              <div class="talk__body">
                <p class="talk__name">{{ $message->users->name }}</p>
                <p class="talk__message">{!! nl2br(htmlspecialchars($message->message)) !!}</p>
              </div>
            </div>
          @else
            <div class="talk__userWrap--reverse">
              <div class="talk__body--reverse">
                <p class="talk__message--reverse">{!! nl2br(htmlspecialchars($message->message)) !!}</p>
              </div>
            </div>
          @endif
        @endforeach
      @endif
    </div>
  </section>
  <form class="message" action="#" method="POST">
    <div class="message__wrap">
      <input type="hidden" name="id" value="{{ $room_id }}">
      <textarea class="message__txt" name="body" placeholder="メッセージ"></textarea>
      <button class="message__iconWrap"><i class="fa-solid fa-paper-plane message__icon"></i></button>
    </div>
  </form>
@endsection