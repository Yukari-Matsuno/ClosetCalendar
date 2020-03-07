@extends('layouts.layouts')

@section('title', '月日のコーディネート')

@section('content')
<main id="detail">
  <h1 class="coordinate__title"> / Coordinate</h1>
  <image class="coordinate__photo" alt="コーディネートの写真">
  <div class="coordinate__item">
    <p class="coordinate__item--title">使用アイテム</p>
    <ul>
      @foreach ($use_items as $use_item)
      @if ($use_item == "No Item")
      @continue
      @endif
      <li>{{ $use_item }}</li>
      @endforeach
    </ul>
  </div>
  <div class="coordinate__ivent">
    <p class="coordinate__ivent--title">月日の出来事</p>
    <p class="coordinate__ivent--text">{{ $coordinate_items->events }}</p>
  </div>

  <div class="detail__button">
    <button class="square-button button"><a href="{{ action('Admin\CoordinateController@destroy', ['id' => $coordinate_items->id]) }}">この日の記録を削除する</a></button>
  </div>
</main>

@endsection
