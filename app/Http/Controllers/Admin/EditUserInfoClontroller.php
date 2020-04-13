<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Hash;
use App\Coordinate;


class EditUserInfoClontroller extends Controller
{
    public function show(){
      return view('admin.change_acount');
    }

    public function editPassword(Request $request) {
        //現在のパスワードが正しいかを調べる
        if(!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->back()->with('change_password_error', '現在のパスワードが間違っています。');
        }

        //現在のパスワードと新しいパスワードが違っているかを調べる
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            return redirect()->back()->with('change_password_error', '新しいパスワードが現在のパスワードと同じです。違うパスワードを設定してください。');
        }

        //パスワードのバリデーション。新しいパスワードは6文字以上、new-password_confirmationフィールドの値と一致しているかどうか。
        $validated_data = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //パスワードを変更
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with('change_password_success', 'パスワードを変更しました。');
    }

    public function editEmail(Request $request) {
        //現在のメールアドレスが正しいかを調べる
        if(!(Hash::check($request->get('current-email'), Auth::user()->email))) {
            return redirect()->back()->with('change_email_error', '現在のメールアドレスが間違っています。');
        }

        //現在のメールアドレスと新しいメールアドレスが違っているかを調べる
        if(strcmp($request->get('current-email'), $request->get('new-email')) == 0) {
            return redirect()->back()->with('change_email_error', '新しいメールアドレスが現在のメールアドレスと同じです。違うメールアドレスを入力してください。');
        }

        //メールアドレスのバリデーション。新しいメールアドレスがnew-password_confirmationフィールドの値と一致しているかどうか。
        $validated_data = $request->validate([
            'current-email' => 'required',
            'new-email' => 'required|confirmed',
        ]);

        //パスワードを変更
        $user = Auth::user();
        $user->email = bcrypt($request->get('new-email'));
        $user->save();

        return redirect()->back()->with('change_email_success', 'メールアドレスを変更しました。');
    }

    public function editName (Request $request) {
      $user = Auth::user();
      $user->name = $request->new_name;
      $user->save();
      return redirect('admin/change')->with('change_name_success', '名前(ニックネーム)を変更しました。');
    }
    public function editBirthday (Request $request) {
      $user = Auth::user();
      $user->birthday = $request->new_birthday;
      $user->save();
      return redirect('admin/change')->with('change_name_success', '誕生日を変更しました。');
    }

    public function destroy(Request $request) {

      $user_id = Auth::id();
      Coordinate::where('user_id', $user_id)->delete();
      User::destroy($user_id);
      return redirect('/');
    }
}
