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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script data-ad-client="ca-pub-6414942686817258" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

  <title>@yield('title')</title>

  </head>

  <body>

  <header>
    <nav class="headernav">
      <ul class="clearfix">
        @guest
          <li><a href="{{ route('login') }}">Login</a></li>
        @else
            <li><a href="{{ route('logout') }}">Logout</a></li>
        @endguest
          <li><a href="{{ url('how-to')}}">What is ?</a></li>
        </ul>
      </nav>
  </header>

  <div class="container">
    @yield('content')
  </div>

</body>
</html>
