function addEvent(calendar,info){
    //addEvent()を使うためにfullcalendar.jsで定義したcalendarを引数で受け取る

    var title = $coordinateOutline;
    //ホントはjsでformのvalue取得とかするんだと思いますが、説明を簡潔にするために割愛します。
    $.ajax({
        url: '/ajax/addEvent',
        type: 'POST',
        dataTape: 'json',
        data:{
            "title":title,
            "date":info.dateStr
            //日程取得
        }
    }).done(function(result) {
        calendar.addEvent({
            id:result['event_id'],
            //php側から受け取ったevent_idをeventObjectのidにセット
            title:title,
            start: info.dateStr,
        });
        //ajaxに成功したらフロント側にeventを追加で表示
    });
}
