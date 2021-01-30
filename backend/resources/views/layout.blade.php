<!DOCTYPE HTML>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>@yield('title')
  </title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
  <header>
    @include('header')
  </header>
  <br>
  <div class="container">
    @yield('content')
  </div>
  <footer class="footer bg-dark  fixed-bottom">
    @include('footer')
  </footer>
</body>

</html>