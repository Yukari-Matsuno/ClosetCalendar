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
    public function index(){
      $user_id = Auth::id();
      $coordinates = Coordinate::whereRaw("user_id = ?", Auth::id())->orderBy('date', 'desc')->simplepaginate(14);

      return view('admin.coordinatelist',['coordinates' => $coordinates]);
    }
}
