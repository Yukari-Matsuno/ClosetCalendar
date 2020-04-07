@extends('layouts.layouts')

@section('title', 'CoordinateList')
<!-- <link rel="stylesheet" href="{{ asset('/css/app.css') }}"> -->
@section('content')
<main id="coordinatelist">
  <h1 class="coordinatelist__title">Coordinate List</h1>

  <form id="coordinatelist__order" action="{{ action('Admin\CoordinateListController@index') }}" method="get">
  <select name="coordinatelist__order">
    <option value=""></option>
    <option value="date">日付順</option>
    <option value="favorite">お気に入り順</option>
  </select>
</form>




  <ul id="app" class="coordinatelist__eachday">
    @foreach ($coordinates as $coordinate)
    <li>
      <div class="clearfix coordinatelist__li">
        <p class="coordinatelist__li--date"><a href="{{ url('admin/coordinate/detail?id=') . $coordinate->id }}">{{substr($coordinate->date, 5, 2) . "/" . substr($coordinate->date, 8, 2) . "　" . $coordinate->events}}</a></p>
        @if ($coordinate->image_path)
        <img src="{{ $coordinate->image_path }}" class="coordinatelist__li--photo">
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

          <div class="coordinatelist__li--rating">
              <star-rating  :read-only="true"
                            :star-size="10"
                            :rating="{{ $coordinate->rating }}">
              </star-rating>
          </div>

          <!-- <div class="coordinatelist__li--rating">
              <star-rating  read-only="true"
                            star-size="20"
                            rating="{{ $coordinate->rating }}">
              </star-rating>
          </div> -->

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
<script>
$('#coordinatelist__order').change(function() {

  $('#coordinatelist__order').submit();

});

</script>
<script src="/js/app.js"></script>

@endsection
