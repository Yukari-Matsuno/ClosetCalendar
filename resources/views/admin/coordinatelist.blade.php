@extends('layouts.layouts')

@section('title', 'CoordinateList')
<!-- <link rel="stylesheet" href="{{ asset('/css/app.css') }}"> -->
@section('content')
<main id="coordinatelist">
  <select name="coordinatelist__order" class="coordinatelist__order">
    <option value="date">日付順</option>
    <option value="favorite">お気に入り順</option>
  </select>
  <h1 class="coordinatelist__title">Coordinate List</h1>

  <ul>
    @foreach ($coordinates as $coordinate)
    <li>
      <div class="clearfix coordinatelist__li">
        <p class="coordinatelist__li--date">{{substr($coordinate->date, 5, 2) . "/" . substr($coordinate->date, 8, 2) . "　" . $coordinate->events}}</p>
        @if ($coordinate->image_path)
        <img src="{{ asset('storage/image/' . $coordinate->image_path) }}" class="coordinatelist__li--photo">
        @else
        <img src="/images/torso.png" class="coordinatelist__li--photo">
        @endif
        <div class="coordinatelist__li--itemli">
          <p>使用アイテム</p>
          <ul>
            <?php $items = [$coordinate->tops, $coordinate->bottoms, $coordinate->outer, $coordinate->shoes, $coordinate->other]; ?>
            @foreach ($items as $item)
              @if ($item != "No Item")
              <li>{{ $item }}</li>
              @endif
            @endforeach
          </ul>
          <div id="app" class="coordinatelist__li--rating">
              <star-rating  read-only="true"
                            star-size="20"
                            rating="{{ $coordinate->rating }}">
              </star-rating>
          </div>
        </div>

      </div>
    </li>
    @endforeach
  </ul>
  <div>
  {{ $coordinates->links() }}
  </div>
  <button class="button coordinatelist__button"><a href="{{ url('calender') }}">←</i></a></button>

</main>
<script src="/js/app.js"></script>

@endsection
