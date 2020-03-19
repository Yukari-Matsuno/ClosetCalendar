<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
  // この一文は何か聞く
  // protected $guarded = array('id');

  public static $rules = array(
      'user_id' => 'required',
  );
}
