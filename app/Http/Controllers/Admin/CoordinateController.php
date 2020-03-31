<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Coordinate;
use Storage;
use Carbon\Carbon;


class CoordinateController extends Controller
{
    public function add(Request $request)
    {
      $user_id = Auth::id();
      if (Auth::check()) {
        $coordinate = new Coordinate;


        return view('admin.create', ['date' => $request->date, 'user_id' => $user_id]);
    } else {
        return view('samplecreate');
    }

    }

    public function create(Request $request)
    {
      // dd($request);
      $user_id = Auth::id();
      $coordinate = new Coordinate;
      $form = $request->all();

      if (isset($form['photo'])) {
        $path = Storage::disk('s3')->putFile('/',$form['photo'],'public');
        $coordinate->image_path = Storage::disk('s3')->url($path);
      } else {
        $coordinate->image_path = null;
      }

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['photo']);
      $form["tops"] == null ? "" : $coordinate->tops = $form["tops"];
      $form["bottoms"] == null ? "" : $coordinate->bottoms = $form["bottoms"];
      $form["outer"] == null ? "" : $coordinate->outer = $form["outer"];
      $form["shoes"] == null ? "" : $coordinate->shoes = $form["shoes"];
      $form["events"] == null ? "" : $coordinate->events = $form["events"];
      $coordinate->date = $form["date"];
      $coordinate->user_id = $form["user_id"];
      $coordinate->rating = $form["rating"];

      // データベースに保存する
      $coordinate->save();

      return redirect('admin/calender');
    }


    public function edit(Request $request) {
      $coordinate = Coordinate::find($request->id);
    if (empty($coordinate)) {
      abort(404);
    }
    return view('admin.edit', ['coordinate_items' => $coordinate]);
    }

    public function update(Request $request)
    {
      $coordinate = Coordinate::find($request->id);
      // 送信されてきたフォームデータを格納する
      $form = $request->all();
      if (isset($form['photo'])) {
        $path = Storage::disk('s3')->putFile('/',$form['photo'],'public');
        $coordinate->image_path = Storage::disk('s3')->url($path);;
        unset($form['photo']);
      } elseif (isset($request->remove)) {
        $coordinate->image_path = null;
        unset($form['remove']);
      }

      unset($form['_token']);

      // 該当するデータを上書きして保存する
      $form["tops"] == null ? "" : $coordinate->tops = $form["tops"];
      $form["bottoms"] == null ? "" : $coordinate->bottoms = $form["bottoms"];
      $form["outer"] == null ? "" : $coordinate->outer = $form["outer"];
      $form["shoes"] == null ? "" : $coordinate->shoes = $form["shoes"];
      $form["events"] == null ? "" : $coordinate->events = $form["events"];
      $coordinate->date = $form["date"];
      $coordinate->rating = $form["rating"];
      $coordinate->save();

      return redirect('admin/calender');
      }


      public function destroy(Request $request)
      {
    // 該当するNews Modelを取得
      $coordinate = Coordinate::find($request->id);
    // 削除する
      $coordinate->delete();
      return redirect('admin/calender');
      }
      }
