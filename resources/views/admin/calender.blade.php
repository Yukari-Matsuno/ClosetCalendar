@extends('layouts.layouts')

@section('title', 'Closet Calender')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/interaction/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.js"></script>

<script>

//本日、カレンダーの開始日、終了日と、曜日のテキストを用意します
var date_now = new Date();
var date_start = new Date(date_now.getFullYear(), date_now.getMonth(), 1);
var date_end = new Date(date_now.getFullYear(), date_now.getMonth(), 1);
var days = ["Sun", "Mon", "Tue", "Wed", "Thr", "Fri", "Sat"];
date_end.setMonth(date_end.getMonth()+12);
date_start.setMonth(date_start.getMonth()-12);


document.addEventListener("DOMContentLoaded", function() {
  var coordinateDateHash = @json($coordinateDateHash);
  var _events = @json($events);
  console.log(_events);

  //FullCalendarを生成します
  var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {


    //プラグインを読み込みます
    plugins: ["dayGrid", "interaction"],




    //ヘッダー内の配置を、左に前月ボタン、中央にタイトル、右に次月ボタンに設定します
    header: {
      left: "prev",
      center: "title",
      right: "next"
    },


    //デフォルト日を本日に設定します
    defaultDate: date_now,

    //有効期間を当月1日から12ヶ月後（1年後）に設定します。
    validRange: {
      start: date_start,
      end: date_end
    },



    //タイトルを書き換えます（2019年8月）
    titleFormat: function(obj) {
      return obj.date.year+"年"+(obj.date.month+1)+"月";
    },

    //曜日のテキストを書き換えます（日〜土）
    columnHeaderText: function(obj) {
      return days[obj.getDay()];
    },

    dateClick: function(info) {
      console.log("info", info);
      info.dayEl.style.backgroundColor = '#ff6666';
      // var str = moment( .date ).format( 'YYYYMMDD' );
      var redirectUrl = `/admin/coordinate/create?date=${info.dateStr}`;
      var coordinate = coordinateDateHash[info.dateStr];
      if (!!coordinate) {
        // IDあった時
        redirectUrl = `/admin/coordinate/detail?id=${coordinate['id']}`;
      }
      location.href = redirectUrl;
    },


     events: _events,

    //イベントのクリック時の処理を加えます
    eventClick: function(info) {
      console.log("info", info);
      info.el.style.borderColor = '#ff6666';
      location.href = `/admin/coordinate/detail?id=${info.event['id']}`;


    }
   });

  calendar.render();


});



</script>


@section('content')
<main id=closet-caleder>
<div class="calender__container">
  <div id ="calendar"></div>
  <button class="button calendar__addtoday"><a href="{{ url('admin/coordinate/create?date=') . $today }}"><i class="fas fa-pen fa-2x"></i></a></button>
</div>
</main>



@endsection
