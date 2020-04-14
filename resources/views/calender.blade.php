<!-- ログインしてない時の表示カレンダー -->

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
  var start = @json($start);
  var end = @json($end);

  //FullCalendarを生成します
  var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {




    //プラグインを読み込みます
    plugins: ["dayGrid", "interaction"],

    //ヘッダー内の配置を、左に前月ボタン、中央にタイトル、右に次月ボタンに設定します
    header: {
      left: "prev",
      center: "title",
      right:" next"
    },

    businessHours:　true,

    //デフォルト日を本日に設定します
    defaultDate: date_now,

    //有効期間を当月1日から12ヶ月後（1年後）に設定します。
    validRange: {
      start: date_start,
      end: date_end
    },


    //タイトルを書き換えます（2019年8月）
    titleFormat: function(obj) {
      return obj.date.year+"/"+(obj.date.month+1);
    },

    //曜日のテキストを書き換えます（日〜土）
    columnHeaderText: function(obj) {
      return days[obj.getDay()];
    },

    // dateClick: function(info) {
    //   console.log("info", info);
    //   info.dayEl.style.backgroundColor = '#ff6666';
    //   location.href = 'create/sample';
    // },

    //イベント情報をJSONファイルから読み込みます
  //   events: [
  //
  //   {
  //     title: '使い方',
  //     start: start,
  //     end: end
  //   }
  //
  //
  // ],

  //   events: [
  //
  //   {
  //     title: 'How to use?',
  //     start: start
  //   }
  //
  //
  // ],


    //イベントのクリック時の処理を加えます
    eventClick: function(obj) {
      alert(obj.event.title);
    }
  });
  calendar.render();
});

</script>


@section('content')
<main id="closet-caleder">
  <div class="calender__container calender__container--for-guest">
    <div class="calender__message-for-guest clearfix">
      <h1>Welcome to<br>Closet Calendar !</h1>
      <p><a href ="{{ url('how-to') }}">What is?</a></p>
      <p><a href ="{{ route('login') }}">Login & Make your Closet Calendar</a></p>
    </div>
    <div id ="calendar" class="calender__for-guest"></div>
  </div>
</main>
<footer>
  <ul class="clearfix footernav">
    <li><a href="{{ url('terms') }}">利用規約<br>プライバシーポリシー</a></li>
    <!-- <li class="footernav__change-info"><a href="{{ url('admin/change') }}" >アカウント情報の変更</a></li> -->
  </ul>
</footer>
@endsection
