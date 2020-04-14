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

      $user_id = Auth::id();
      $coordinate = new Coordinate;
      $form = $request->all();

      if (isset($form['photo'])) {
        $path = Storage::disk('s3')->putFile('/',$form['photo'],'public');
        $coordinate->image_path = Storage::disk('s3')->url($path);
        $file = $request->file('photo');
        // 画像の拡張子を取得
        $extension = $request->file('photo')->getClientOriginalExtension();
        // 画像の名前を取得
        $filename = $request->file('photo')->getClientOriginalName();
        // 画像をリサイズ
        // $image = \Image::make(file_get_contents($form['photo']->getRealPath()));
        $resize_img = \Image::make($file)->resize(80, null, function ($constraint) {$constraint->aspectRatio();})->crop(80, 80)->encode($extension);
        // s3のuploadsファイルに追加
        $path = Storage::disk('s3')->put('/uploads/'.$filename,(string)$resize_img, 'public');
        // 画像のURLを参照
        $coordinate->image_path_100 = Storage::disk('s3')->url('uploads/'.$filename);


  // $image->resize(100, null, function ($constraint) {$constraint->aspectRatio();})->save(public_path().'/images/100-'.$form['photo']->hashName());
//       $path = Storage::disk('s3')->putFile('/',  $image->resize(100, null, function ($constraint) {$constraint->aspectRatio();})
// ,'public');
//       $coordinate->image_path = Storage::disk('s3')->url($path);

      } else {
        $coordinate->image_path = null;
      }

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['photo']);
      $coordinate->tops = $form["tops"];
      $coordinate->bottoms = $form["bottoms"];
      $coordinate->outer = $form["outer"];
      $coordinate->shoes = $form["shoes"];
      $coordinate->events = $form["events"];
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
        $coordinate->image_path = Storage::disk('s3')->url($path);
        $file = $request->file('photo');
        // 画像の拡張子を取得
        $extension = $request->file('photo')->getClientOriginalExtension();
        // 画像の名前を取得
        $filename = $request->file('photo')->getClientOriginalName();
        // 画像をリサイズ
        $resize_img = \Image::make($file)->resize(80, null, function ($constraint) {$constraint->aspectRatio();})->crop(80, 80)->encode($extension);
        // s3のuploadsファイルに追加
        $path = Storage::disk('s3')->put('/uploads/'.$filename,(string)$resize_img, 'public');
        // 画像のURLを参照
        $coordinate->image_path_100 = Storage::disk('s3')->url('uploads/'.$filename);
        unset($form['photo']);
      } elseif (isset($request->remove)) {
        $coordinate->image_path = null;
        $coordinate->image_path_100 = null;
        unset($form['remove']);
      }

      unset($form['_token']);

      //該当するデータを上書きして保存する
      $coordinate->tops = $form["tops"];
      $coordinate->bottoms = $form["bottoms"];
      $coordinate->outer = $form["outer"];
      $coordinate->shoes = $form["shoes"];
      $coordinate->events = $form["events"];
      $coordinate->date = $form["date"];
      $coordinate->rating = $form["rating"];
      // dd([$form, $coordinate, $coordinate->save(), $form["events"] == null]);
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
