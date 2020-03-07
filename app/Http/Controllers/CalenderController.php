<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class CalenderController extends Controller
{
  public function show()
  {

    if (Auth::check()) {
      return view('admin.calender');
    } else {
      return view('calender');
    }
  }
}
