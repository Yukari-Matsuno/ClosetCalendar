<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class BirthdayController extends Controller
{
  public function show(){
    $name = Auth::user()->name;
    return view('admin.birthday', ['name' => $name]);
  }
}
