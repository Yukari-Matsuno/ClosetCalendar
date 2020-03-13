@extends('layouts.layouts')

@section('title', '{{ $coordinate_items->date }}のコーディネート')

@section('content')
<main id="detail">
  <h1 class="coordinate__title">Coordinate Of {{ substr($coordinate_items->date, 0, 4) . "/" . substr($coordinate_items->date, 5, 2) . "/" . substr($coordinate_items->date, 8, 2) }}</h1>
  <div class="coordinate__photo">
    @if ($coordinate_items->image_path)
    <img src="{{ asset('storage/image/' . $coordinate_items->image_path)}}" alt="コーディネートの写真">
    @endif
    </div>
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
    <p class="coordinate__ivent--title">{{ substr($coordinate_items->date, 5, 2) . "/" . substr($coordinate_items->date, 8, 2) }}の出来事</p>
    <p class="coordinate__ivent--text">{{ $coordinate_items->events }}</p>
  </div>

  <div class="detail__button">
    <button class="square-button button coordinate__edit"><a href="{{ action('Admin\CoordinateController@edit', ['id' => $coordinate_items->id]) }}">編集する</a></button>
    <button class="square-button button"><a href="{{ action('Admin\CoordinateController@destroy', ['id' => $coordinate_items->id]) }}">削除する</a></button>
  </div>
</main>

@endsection
