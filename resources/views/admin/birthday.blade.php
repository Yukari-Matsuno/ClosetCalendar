@extends('layouts.layouts')

@section('title', 'HappyBirthday')

@section('content')
<main id="birthday">
<div class="birthday__card">
<p class="birthday__name">{{ $name }}さん</p>
<p class="birthday__message">素敵な1日をお過ごし下さい</p>
<img src="/images/birthday.jpg" class="birthday__image" alt="誕生日カードの画像">

</div>
</main>

@endsection
