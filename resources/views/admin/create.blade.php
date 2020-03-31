@extends('layouts.layouts')

@section('title', 'コーディネートを投稿')


@section('content')
<main id="create">
<div class="form">
  <form action="{{ action('Admin\CoordinateController@create') }}" method="post" enctype="multipart/form-data">
    <h1 class="create__title">{{ substr($date, 0, 4) . "/" . substr($date, 5, 2) . "/" . substr($date, 8, 2) }}のコーディネート</h1>
    <p class="items">何を着た？(着る？)</p>
    <dl>
      <dt>Tops</dt>
      <dd><input type="text" name="tops"></dd>
      <dt>Bottoms</dt>
      <dd><input type="text" name="bottoms"></dd>
      <dt>Outer</dt>
      <dd><input type="text" name="outer"></dd>
      <dt>Shoes</dt>
      <dd><input type="text" name="shoes"></dd>
      <dt>Other</dt>
      <dd><input type="text" name="other"></dd>
      <dt class="event">誰とどこ行く？</dt>
      <dd><input type="text" name="events"></dd>
      <dt class="photo">Photo</dt>
      <dd><input type="file" name="photo" class="photoupload"></dd>
      <dt class="rating">今日のコーディネートは？</dt>
      <dd>
        <select name="rating" class="rating">
          <option value="0"></option>
          <option value="5">お気に入り！</option>
          <option value="4">まぁまぁ</option>
          <option value="3">普通</option>
          <option value="2">イマイチ…</option>
          <option value="1">ダメ</option>
        </select>



    </dl>
    <!-- <div id="app">
      <star-rating :increment="1"></star-rating>

    </div> -->

    <button type="submit" class="button square-button">記録する</button>
    <input type="hidden" name="date" value="{{ $date }}">
    <input type="hidden" name="user_id" value="{{ $user_id }}">
    {{ csrf_field() }}
  </form>
</div>

</main>
<script src="/js/app.js"></script>

@endsection
