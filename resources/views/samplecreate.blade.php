@extends('layouts.layouts')

@section('title', 'コーディネートを投稿')

@section('content')
<main id="create">
<div class="form">
  <form>
    <p>20XX/〇〇/〇〇のコーディネート</p>
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
    </dl>
    <button type="submit" class="button square-button"><a href="{{ route('login') }}">ログイン・アカウント登録をしてコーディネートを記録する！</a></button>
  </form>
</div>

</main>

@endsection
