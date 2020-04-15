@extends('layouts.layouts')

@section('title', '{{ $coordinate_items->date }}のコーディネート')


@section('content')
<main id="detail">
  <h1 class="coordinate__title">Coordinate Of {{ substr($coordinate_items->date, 0, 4) . "/" . substr($coordinate_items->date, 5, 2) . "/" . substr($coordinate_items->date, 8, 2) }}</h1>
  <div class="coordinate__photo--wrapper">
    @if ($coordinate_items->image_path)
    <img src="{{ $coordinate_items->image_path }}" class="coordinate__photo" alt="コーディネートの写真">
    @endif
  </div>

  <div id="app">
      <star-rating  read-only="true"
                    star-size="20"
                    rating="{{ $coordinate_items->rating }}">
      </star-rating>
  </div>

  <div class="coordinate__item">
    <p class="coordinate__item--title">使用アイテム</p>
    <ul>
      @foreach ($use_items as $use_item)
      @if ($use_item == null)
      @continue
      @endif
      <li>{{ $use_item }}</li>
      @endforeach
    </ul>
  </div>
  <div class="coordinate__ivent">
    <p class="coordinate__ivent--title">{{ substr($coordinate_items->date, 5, 2) . "/" . substr($coordinate_items->date, 8, 2) }}の出来事</p>
    @if($coordinate_items->events)
    <p class="coordinate__ivent--text">{{ $coordinate_items->events }}</p>
    @else
    <p class="coordinate__ivent--text">Nothing much...</p>
    @endif
  </div>



  <div class="detail__button">
    <button class="square-button button coordinate__edit"><a href="{{ action('Admin\CoordinateController@edit', ['id' => $coordinate_items->id]) }}">編集する</a></button>
    <button class="square-button button" id="check">削除する</button>
    <script>
      var check = document.getElementById('check');
      check.addEventListener('click', function() {
        check = window.confirm('削除してOK？');
        if(check == true){
          location.href = "{{ action('Admin\CoordinateController@destroy', ['id' => $coordinate_items->id]) }}";
        }
      })
    </script>
  </div>
</main>
<div>
<a href="https://rpx.a8.net/svt/ejp?a8mat=3BBLMD+CC5E2A+2HOM+6TMLD&rakuten=y&a8ejpredirect=http%3A%2F%2Fhb.afl.rakuten.co.jp%2Fhgc%2F0eac8dc2.9a477d4e.0eac8dc3.0aa56a48%2Fa20041592984_3BBLMD_CC5E2A_2HOM_6TMLD%3Fpc%3Dhttp%253A%252F%252Fbooks.rakuten.co.jp%252F%26m%3Dhttp%253A%252F%252Fbooks.rakuten.co.jp%252F" rel="nofollow">
<img class="cm" src="http://hbb.afl.rakuten.co.jp/hsb/0eb46e44.85d79ba9.0eb46e39.39a610d9/" border="0"></a>
<img border="0" width="1" height="1" src="https://www14.a8.net/0.gif?a8mat=3BBLMD+CC5E2A+2HOM+6TMLD" alt="">
</div>

<script src="/js/app.js"></script>
@endsection
