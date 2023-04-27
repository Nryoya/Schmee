@extends('layouts.messageLayout')
@section('content')
  <section class="talk">
    <div class="talk__wrap">
      <div class="talk__userWrap">
        <div class="talk__user">
          <img class="talk__user-img" src="./img/raghav-modi-P1vXpgpL208-unsplash.jpg" alt="">
        </div>
        <div class="talk__body">
          <p class="talk__name">アインシュタイン</p>
          <p class="talk__message">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum dolorum commodi architecto dolore odio nulla consectetur nobis, quas enim cum repudiandae culpa explicabo natus voluptate esse. Quam in eos repellat.</p>
        </div>
      </div>
      <div class="talk__userWrap--reverse">
        <div class="talk__user">
          <img class="talk__user-img" src="./img/raghav-modi-P1vXpgpL208-unsplash.jpg" alt="">
        </div>
        <div class="talk__body--reverse">
          <p class="talk__name">アインシュタイン</p>
          <p class="talk__message--reverse">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum dolorum commodi architecto dolore odio nulla consectetur nobis, quas enim cum repudiandae culpa explicabo natus voluptate esse. Quam in eos repellat.</p>
        </div>
      </div>
    </div>
  </section>
  <form class="message" action="#" method="POST">
    <div class="message__wrap">
      <textarea class="message__txt" name="" placeholder="メッセージ"></textarea>
      <button class="message__iconWrap"><i class="fa-solid fa-paper-plane message__icon"></i></button>
    </div>
  </form>
@endsection