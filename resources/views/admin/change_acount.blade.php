

@extends('layouts.app')
<script>
  // document.getElementById("destroy").onclick = function(){
  function confirm_destroy(){
    window.confirm("本当にアカウントを削除しますか？今後このメールアドレス、パスワードではログインできなくなります。また、登録したコーディネートは全て削除されます。");
      if(check == true){
        location.href = "{{ action('Admin\EditUserInfoClontroller@destroy') }}";
      }
  // };
  }
</script>
@section('content')
<main id="edit-acount-infomaition">
  <div class="edit-acount-infomaition__list">
    <h1 class="edit-acount-infomaition__list--title">アカウント情報の変更</h1>
      <ul>
        <li>
          <div class="card-header">パスワードを変更する</div>

        @if (session('edit_password_error'))
          <div class="container mt-2">
            <div class="alert alert-danger">
              {{session('edit_password_error')}}
            </div>
          </div>
        @endif

        @if (session('edit_password_success'))
          <div class="container mt-2">
            <div class="alert alert-success">
              {{session('edit_password_success')}}
            </div>
          </div>
        @endif

        <div class="card-body">
          <form method="POST" action="{{route('editpassword')}}">
            @csrf
            <div class="form-group">
              <label for="current">
                現在のパスワード
              </label>
              <div>
                <input id="current" type="password" class="form-control" name="current-password" required autofocus>
              </div>
            </div>
            <div class="form-group">
              <label for="password">
                新しいパスワード
              </label>
              <div>
                <input id="password" type="password" class="form-control" name="new-password" required>
                @if ($errors->has('new-password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('new-password') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="confirm">
                新しいパスワード（確認用）
              </label>
              <div>
                <input id="confirm" type="password" class="form-control" name="new-password_confirmation" required>
              </div>
            </div>
            <div>
              <button type="submit" class="btn btn-primary">変更</button>
            </div>
          </form>
        </div>
        </li>

        <li>
          <div class="card-header">メールアドレスを変更する</div>

        @if (session('edit_email_error'))
          <div class="container mt-2">
            <div class="alert alert-danger">
              {{session('edit_email_error')}}
            </div>
          </div>
        @endif

        @if (session('edit_email_success'))
          <div class="container mt-2">
            <div class="alert alert-success">
              {{session('edit_email_success')}}
            </div>
          </div>
        @endif

        <div class="card-body">
          <form method="POST" action="{{route('editemail')}}">
            @csrf
            <div class="form-group">
              <label for="current">
                現在のメールアドレス
              </label>
              <div>
                <input id="current" type="email" class="form-control" name="current-email" required autofocus>
              </div>
            </div>
            <div class="form-group">
              <label for="email">
                新しいメールアドレス
              </label>
              <div>
                <input id="email" type="email" class="form-control" name="new-email" required>
                @if ($errors->has('new-email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('new-email') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="confirm">
                新しいメールアドレス（確認用）
              </label>
              <div>
                <input id="confirm" type="email" class="form-control" name="new-email_confirmation" required>
              </div>
            </div>
            <div>
              <button type="submit" class="btn btn-primary">変更</button>
            </div>
          </form>
        </div>
        </li>

        <li>
          <p class="card-header">名前(ニックネーム)を変更する</p>
          @if (session('edit_name_success'))
            <div class="container mt-2">
              <div class="alert alert-success">
                {{session('edit_name_success')}}
              </div>
            </div>
          @endif
          <div class="card-body">
            <form method="POST" action="{{route('editname')}}" class="form-group">
              <input class="form-control form-control-input" type="text" name="new_name"  required>
              @csrf
              <button type="submit" class="btn btn-primary">変更</button>
            </form>
          </div>
        </li>
        <li>
          <p class="card-header">誕生日を変更する</p>
          @if (session('edit_birthday_success'))
            <div class="container mt-2">
              <div class="alert alert-success">
                {{session('edit_birthday_success')}}
              </div>
            </div>
          @endif
          <div class="card-body">
            <form method="POST" action="{{route('editbirthday')}}" class="form-group">
              <input class="form-control form-control-input" type="date" name="new_birthday"  required>
              @csrf
              <button type="submit" class="btn btn-primary">変更</button>
            </form>
          </div>
        </li>
        <li>
          <p class="card-header">アカウントを削除する</p>
          <div class="card-body">
            <p class="caution">※今後このメールアドレス、パスワードではログインできなくなります。<br>また、登録したコーディネートが全て削除されます。</p>
            <!-- <button  class="btn btn-primary" id="destroy">削除する</button> -->
            <button  class="btn btn-primary danger-button" onclick="confirm_destroy();">削除する</button>
          </div>

        </li>
      </ul>

  </div>
</main>

@endsection
