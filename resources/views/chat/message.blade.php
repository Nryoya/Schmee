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
                <span class="talk__message-time">{{ $message->created_at }}</span>
              </div>
            </div>
          @else
            <div class="talk__userWrap talk__userWrap--reverse">
              <div class="talk__body talk__body--reverse">
                <p class="talk__message">{!! nl2br(htmlspecialchars($message->message)) !!}</p>
                <span class="talk__message-time">{{ $message->created_at }}</span>
              </div>
              <form class="talk__delete" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $message->id }}">
                <button class="talk__delete-btn"><i class="fa-solid fa-trash-can talk__delete-icon"></i></button>
              </form>
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
                <span class="talk__message-time">{{ $message->created_at }}</span>
              </div>
            </div>
          @else
            <div class="talk__userWrap talk__userWrap--reverse">
              <div class="talk__body talk__body--reverse">
                <input type="hidden" name="id" value="{{ $message->id }}">
                <p class="talk__message">{!! nl2br(htmlspecialchars($message->message)) !!}</p>
                <span class="talk__message-time">{{ $message->created_at }}</span>
              </div>
              <form class="talk__delete" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $message->id }}">
                <button class="talk__delete-btn"><i class="fa-solid fa-trash-can talk__delete-icon"></i></button>
              </form>
            </div>
          @endif
        @endforeach
      @endif
    </div>
  </section>
  <div class="message">
    <div class="message__wrap">
      @csrf
      <input type="hidden" name="room_id" value="{{ $room_id }}" class="room_id">
      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" class="user_id">
      <textarea class="message__txt" name="body" placeholder="メッセージ"></textarea>
      <button class="message__iconWrap"><i class="fa-solid fa-paper-plane message__icon"></i></button>
    </div>
  </div>
@endsection