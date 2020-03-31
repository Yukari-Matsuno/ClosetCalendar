@extends('layouts.layouts')

@section('title', 'HappyBirthday')

@section('content')
<main id="birthday">
<h1>HappyBirthday{{ $name }}さん</h1>
<p>素敵な1日をお過ごし下さい</p>
<img src="/images/birthday.jpg">
</main>

@endsection
