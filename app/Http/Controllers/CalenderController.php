<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Coordinate;
use App\User;
use Carbon\Carbon;



class CalenderController extends Controller
{
  public function index()
  {
    $user_id = Auth::id();
    if (Auth::check()) {
      // Coordinateの一覧を取得
      $coordinates = Coordinate::whereRaw("user_id = ?", Auth::id())->get();
      // 日付けをキーとし、Cordinate::idとする連想配列を作る
      $coordinateDateHash = [];
      foreach ($coordinates as $coordinate) {
        $coordinateDateHash[$coordinate->date]["id"]=$coordinate->id;
        $coordinateDateHash[$coordinate->date]["events"]=$coordinate->events;
      }
      $events = [];
      foreach($coordinateDateHash as $date=>$item){
        $events[] = [
          'id' => $item['id'],
          'title' => $item['events'],
          'start' => $date
        ];
      }
      $user = Auth::user();
      $birthday = $user->birthday;
      $events[] = [
        'id' => 'BD',
        'title' => 'HappyBirthday!',
        'start' => $birthday
      ];

      $today = Carbon::today()->toDateString();
      return view('admin.calender', ['coordinateDateHash' => $coordinateDateHash, 'events' => $events, 'today' => $today]);
    } else {

        $now = Carbon::now();
        $month = str_split($now->month);
        if (count($month) == 1){
          $month = "0" . $month[0];
        } else {
          $month = implode($month);
        }
        $start = $now->year. '-' . $month . '-' . '01';
        $end = $now->year. '-' . $month . '-' . '02';


      return view('calender', ['start' => $start, 'end' => $end]);

    }
  }

  public function show(Request $request) {
    $coordinate = Coordinate::find($request->id);
    $items = [$coordinate->tops, $coordinate->bottoms, $coordinate->outer, $coordinate->shoes, $coordinate->other];
    return view('admin.detail', ['coordinate_items' => $coordinate, 'use_items' => $items]);
  }


  // public function setCoordinate(Request $request){
  //   // Coordinateの一覧を取得
  //   $coordinate = Coordinate::all();
  //   // 日付けをキーとし、Cordinate::idとする連想配列を作る
  //   $cordinateDateHash = [];
  //   foreach ($coordinates as $coordinate) {
  //     $cordinateDateHash[$coordinate->date]=$coordinate->id;
  //   }
  //   $coordinateOutline = [$coorsinate->image_path, $coordinate->events];
  //   echo json_encode($coordinateOutline);
  //
  // }
}
