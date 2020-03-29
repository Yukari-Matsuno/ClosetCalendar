<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Coordinate;
use App\User;
use Carbon\Carbon;


class CoordinateListController extends Controller
{
    public function index(){
      $user_id = Auth::id();
      $coordinates = Coordinate::whereRaw("user_id = ?", Auth::id())->orderBy('date', 'desc')->get();
    
      return view('admin.coordinatelist',['coordinates' => $coordinates]);
    }
}
