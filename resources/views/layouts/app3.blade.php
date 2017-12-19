<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap-theme-simplex.min.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->

    <style type="text/css">
        .container {
            max-width: 1024px;
            min-width: 600px;
        }

        body {
            padding-top: 41px;
        }

        #klh-logo {
            width: 400px;
        }

        #klh-logo img:nth-child(1) {
            position: absolute;
            top: 1px;
            width: 68px;
        }

        #klh-logo img:nth-child(2) {
            position: absolute;
            top: 0;
            left: 105px;
            width: 41px;
        }

        #klh-logo span:nth-child(3) {
            position: absolute;
            top: 4px;
            left: 150px;
            font-weight: bold;
            font-size: 14px;
        }

        #klh-logo span:nth-child(4) {
            position: absolute;
            top: 18px;
            left: 150px;
            font-weight: bold;
            font-size: 12px;
        }

        .panel {
            border-radius: 0;
        }

        .panel .panel-heading {
            border-radius: 0;
        }

        footer {
            background-color: #d9230f;
            height: 81px;
        }

        #klh-logo-footer img:nth-child(1) {
            position: absolute;
            top: 1px;
            left: 30px;
            width: 68px;
        }

        #klh-logo-footer img:nth-child(2) {
            position: absolute;
            top: 0;
            left: 105px;
            width: 41px;
        }

        #klh-logo-footer span:nth-child(3) {
            position: absolute;
            top: 38px;
            left: 30px;
            font-weight: bold;
            font-size: 14px;
            color: #fac0ba;
        }

        #klh-logo-footer span:nth-child(4) {
            position: absolute;
            top: 54px;
            left: 30px;
            font-weight: bold;
            font-size: 12px;
            color: #fac0ba;
        }

        #klh-logo-footer span:nth-child(5) {
            position: absolute;
            top: 66px;
            left: 30px;
            font-size: 12px;
            color: #fac0ba;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" id="klh-logo" href="#">
                            <img src="{{ asset('images/CITES_logo_high_resolution_white.png') }}">
                            <img src="{{ asset('images/favicon/android-icon-48x48.png') }}">
                            <span>KEMENTERIAN LINGKUNGAN HIDUP DAN KEHUTANAN</span>
                            <span>REPUBLIK INDONESIA</span>
                        </a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li @if(Request::is('/')) class="klh-active" @endif><a aria-expanded="false" role="button"
                                                                                   href="{{ url('/') }}">Home</a></li>
                            <!-- Authentication Links -->
                            @guest
                                <li @if(Request::is('login')) class="klh-active" @endif><a
                                            href="{{ route('login') }}">Login</a></li>
                                <li @if(Request::is('register')) class="klh-active" @endif><a
                                            href="{{ route('register') }}">Register</a></li>
                            @else
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false" aria-haspopup="true">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('profile') }}">
                                                My Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
	                                                     document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endguest
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </div>
        </div>
    </div>
</nav>

@yield('content')

<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-7" id="klh-logo-footer">
                <img src="{{ asset('images/CITES_logo_high_resolution_white.png') }}">
                <img src="{{ asset('images/favicon/android-icon-48x48.png') }}">
                <span>KEMENTERIAN LINGKUNGAN HIDUP DAN KEHUTANAN</span>
                <span>REPUBLIK INDONESIA</span>
                <span>www.menlhk.go.id - Copyright &copy; 2017</span>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery-3.2.1.slim.min.js') }}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>