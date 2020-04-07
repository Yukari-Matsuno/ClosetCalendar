@extends('layouts.layouts')

@section('title', 'コーディネートを編集')

@section('content')
<main id="edit">

<div class="form">
  <form action="{{ action('Admin\CoordinateController@edit') }}" method="post" enctype="multipart/form-data">
    <p class="items">何を着た？(着る？)</p>
    <dl>
      <dt>Tops</dt>
      <dd><input type="text" name="tops" value="{{ $coordinate_items->tops }}"></dd>
      <dt>Bottoms</dt>
      <dd><input type="text" name="bottoms" value="{{ $coordinate_items->bottoms }}"></dd>
      <dt>Outer</dt>
      <dd><input type="text" name="outer" value="{{ $coordinate_items->outer }}"></dd>
      <dt>Shoes</dt>
      <dd><input type="text" name="shoes" value="{{ $coordinate_items->shoes }}"></dd>
      <dt>Other</dt>
      <dd><input type="text" name="other" value="{{ $coordinate_items->other }}"></dd>
      <dt class="event">誰とどこ行く？</dt>
      <dd><input type="text" name="events" value="{{ $coordinate_items->events }}"></dd>
      <dt class="photo">Photo</dt>
      <dd><input type="file" name="photo" class="photoupload"></dd>
        <div class="setting-photo">
        設定中: {{ $coordinate_items->image_path }}
        </div>

        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="remove" value="true">削除
          </label>
        </div>
        <dt class="rating">今日のコーディネートは？</dt>
        <dd>
          <select name="rating" class="rating">
            <option value="0" <?php if ($coordinate_items->rating == 0){ echo "selected"; } ?></option>
            <option value="5" <?php if ($coordinate_items->rating == 5){ echo "selected"; } ?>>お気に入り！</option>
            <option value="4" <?php if ($coordinate_items->rating == 4){ echo "selected"; } ?>>まぁまぁ</option>
            <option value="3" <?php if ($coordinate_items->rating == 3){ echo "selected"; } ?>>普通</option>
            <option value="2" <?php if ($coordinate_items->rating == 2){ echo "selected"; } ?>>イマイチ…</option>
            <option value="1" <?php if ($coordinate_items->rating == 1){ echo "selected"; } ?>>ダメ</option>
          </select>
    </dl>
    <input type="hidden" name="id" value="{{ $coordinate_items->id }}">
    <input type="hidden" name="date" value="{{ $coordinate_items->date }}">
    <button type="submit" class="button square-button">更新する</button>
    {{ csrf_field() }}
  </form>
</div>

</main>

@endsection
