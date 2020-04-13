<!DOCTYPE html>
<html lang="ja">
<head>

  <meta charset='UTF-8'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/css/stylesheet.css">
  <link rel="stylesheet" href="/css/normalize.css">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script><!-- Scripts（Jquery） -->

  </head>



  <footer>
    <ul class="clearfix footernav">
      <li><a href="{{ route('terms') }}">利用規約<br>プライバシーポリシー</a></li>
      <li>アカウント情報の変更</li>
    </ul>
  </footer>

  </html>
