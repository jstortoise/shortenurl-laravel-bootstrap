<!DOCTYPE HTML>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('css/style.css') }}">
  <script type="text/javascript" src="{{ url('js/jquery-3.2.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('js/bootstrap.js') }}"></script>
  <script type="text/javascript" src="{{ url('js/validator.js') }}"></script>
</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">ShortenURL</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
        <ul class="nav navbar-nav">
          <li class="@if (Request::path() == '/') active @endif"><a href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a></li>
          @if (session()->exists('email'))
            <li class="@if (Request::path() == 'list') active @endif"><a href="{{ url('/list') }}">URL List <span class="sr-only">(current)</span></a></li>
          @endif
        </ul>
        <ul class="nav navbar-nav navbar-right">
          @if (session()->exists('email'))
            <li><a href="{{ url('/logout') }}">Logout</a></li>
          @else
            <li><a href="{{ url('/signup') }}">Signup</a></li>
            <li><a href="{{ url('/login') }}">Login</a></li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
