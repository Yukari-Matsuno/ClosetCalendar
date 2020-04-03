<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Coordinate;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class CoordinateListController extends Controller
{
    public function index(Request $request){
      $order_request = $request->coordinatelist__order;
      // dd($order_request);
      $user_id = Auth::id();

      if($order_request == ""){
        $coordinates = Coordinate::where('user_id', Auth::id())->orderBy('date', 'desc')->simplepaginate(14);

      } elseif($order_request == "favorite") {

          $coordinates = Coordinate::where('user_id', Auth::id())->orderBy('rating', 'desc')->orderBy('date', 'desc')->simplepaginate(14);
          // dd($coordinates);
      } else {
          $coordinates = Coordinate::where('user_id', Auth::id())->orderBy('date', 'desc')->simplepaginate(14);
      }

      return view('admin.coordinatelist', ['coordinates' => $coordinates]);




      // if($request == 'favorite'){
      //
      //   return redirect('admin/coordinate/list', ['coordinates' => $coordinates]);
      // } elseif($request == 'date') {
      //
      //
      // } else {
      //
      // }


    }
}
