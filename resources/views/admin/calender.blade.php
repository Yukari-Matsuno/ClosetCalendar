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
      return obj.date.year+"/"+(obj.date.month+1);
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

    eventRender: function(info) {
      var windowWidth = $(window).width();
      var windowSm = 767;
      if(windowWidth > windowSm){
        if(info.event.extendedProps.img){
          console.log(info.event.extendedProps);
          // $(element['img'])  //imgプロパティが存在するイベントだけtitleを画像に差し替え
          // .css("border-color", "transparent")
          // .css("background-color", "transparent")
          // .html('<img src="'+events.img+'" />');
          var el = $(info.el).html();
          $(info.el).html(el+'<img src="'+info.event.extendedProps.img+'" />');
          // element.html('<img src="'+events.img+'" />');
        } 

      }
    },

    events: _events,




    //イベントのクリック時の処理を加えます
    eventClick: function(info) {
      console.log("info", info);
      info.el.style.borderColor = '#ff6666';
      if(info.event['id'] === 'BD'){
        location.href = '/admin/happybirthday';
      } else {
        location.href = `/admin/coordinate/detail?id=${info.event['id']}`;
      }
    },

   });

  calendar.render();


});



</script>


@section('content')
<main id=closet-caleder>
<div class="calender__container">
  <div id ="calendar"></div>
</div>
<button class="button calendar__addtoday"><a href="{{ url('admin/coordinate/create?date=') . $today }}"><i class="fas fa-pen fa-2x"></i></a></button>
<button class="button square-button calendar__showlist"><a href="{{ action('Admin\CoordinateListController@index') }}">コーディネートを一覧で見る</a></button>

</main>

<div class="cm">
<a href="https://px.a8.net/svt/ejp?a8mat=3BBLMD+CCQTO2+50+2HJDO1" rel="nofollow">
<img class="cm" border="0" width="234" height="60" alt="" src="https://www26.a8.net/svt/bgt?aid=200415541747&wid=001&eno=01&mid=s00000000018015039000&mc=1"></a>
<img border="0" width="1" height="1" src="https://www10.a8.net/0.gif?a8mat=3BBLMD+CCQTO2+50+2HJDO1" alt="">
</div>
<footer class="footer-for-user">
  <ul class="clearfix footernav">
    <li><a href="{{ url('terms') }}">利用規約<br>プライバシーポリシー</a></li>
    <li class="footernav__change-info"><a href="{{ url('admin/change') }}" >アカウント情報の変更</a></li>
  </ul>
</footer>
@endsection
