<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Coordinate;

class CoordinateController extends Controller
{
    public function show()
    {
      return view('admin.create');
    }

    public function create(Request $request)
    {
      $coordinate = new Coordinate;
      $form = $request->all();

      if (isset($form['photo'])) {
        $path = $request->file('photo')->store('public/image');
        $coordinate->image_path = basename($path);
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

      // データベースに保存する
      $coordinate->save();

      return redirect('admin/calender');
    }

    public function showDetail(Request $request) {
      $coordinate = Coordinate::find($request->id);
      $items = [$coordinate->tops, $coordinate->bottoms, $coordinate->outer, $coordinate->shoes, $coordinate->other];
      return view('admin.detail', ['coordinate_items' => $coordinate, 'use_items' => $items]);
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
        $path = $request->file('photo')->store('public/image');
        $coordinate->image_path = basename($path);
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
