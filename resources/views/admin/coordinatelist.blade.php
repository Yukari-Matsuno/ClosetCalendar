@extends('layouts.layouts')

@section('title', 'CoordinateList')

@section('content')
<main id="coordinatelist">
  <ul>
    @foreach ($coordinates as $coordinate)

    <li>
      <p>{{$coordinate->events}}</p>
      @if ($coordinate->image_path)
        <img src="{{ asset('storage/image/' . $coordinate->image_path) }}">
      @else
        <img src="/images/torso.png">
      @endif
      <div class="coordinatelist__itemli">
        <ul>
          <?php $items = [$coordinate->tops, $coordinate->bottoms, $coordinate->outer, $coordinate->shoes, $coordinate->other]; ?>
          @foreach ($items as $item)
            @if ($item != "No Item")
          <li>{{ $item }}</li>
            @endif
          @endforeach
        </ul>
    </li>

    @endforeach
  </ul>


</main>

@endsection
