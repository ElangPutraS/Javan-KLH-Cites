<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap-theme-lumen.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/sticky-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <style type="text/css">
        .container {
            min-width: 380px;
        }

        .news-date {
            background: #4D8B13;
            width: 50px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            float: left;
            margin-right: 10px;
        }

        .news-date hr {
            margin: 0;
            padding: 0;
        }

        @media screen and (min-width: 380px) {
            #welcome-image {
                margin-bottom: 20px;
                height: 280px;
                background: lightblue url("{{ asset('images/twilight-forest-wallpaperr.jpg') }}") no-repeat fixed center;
            }
        }

        @media screen and (min-width: 1280px) {
            #welcome-image {
                margin-bottom: 20px;
                height: 480px;
                background: lightblue url("{{ asset('images/twilight-forest-wallpaperr.jpg') }}") no-repeat fixed center;
            }
        }
    </style>
    <script>
        window.baseUrl = '{{ url('/') }}';
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" @if(Request::is('/')) style="margin-bottom: 0;" @endif>
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('images/Lambang_Kementerian_Lingkungan_Hidup_dan_Kehutanan.png') }}" style="top: 0; position: absolute; width: 51px;">
                        <span style="top: 7px; position: absolute; margin-top: 0; margin-left: 56px; font-size: 16px; font-weight: bold;">KEMENTERIAN LINGKUNGAN HIDUP</span>
                        <span style="top: 22px; position: absolute; margin-top: 0; margin-left: 56px; font-size: 14px;">REPUBLIK INDONESIA</span>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/') }}">Beranda</a></li>
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li>
                                        <a href="{{ route('profile') }}">
                                            My Profile
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        <footer class="footer">
          <div class="container">
            <div class="col-sm-4">
                <img src="{{ asset('images/Lambang_Kementerian_Lingkungan_Hidup_dan_Kehutanan.png') }}" style="width: 51px;">
                <br>
                <span style="font-size: 16px; font-weight: bold;">KEMENTERIAN LINGKUNGAN HIDUP</span>
                <br>
                <span style="font-size: 14px;">REPUBLIK INDONESIA</span>
                <br>
                <span style="font-size: 12px;">www.menlh.go.id - Copyright &copy; 2017</span>
                <!--p class="text-muted">Place sticky footer content here.</p-->
            </div>

            <div class="col-sm-4">
                <h3 style="margin-top: 10px;">Hubungi Kami</h3>
                <p><i class="fa fa-home"></i> Jl. D.I. Panjaitan Kav. 24 Kebon Nanas, Jakarta Timur 13410</p>
                <p><i class="fa fa-phone"></i> Telepon: +62 (21) 8580067-68</p>
            </div>

            <div class="col-sm-4">
                <h3 style="margin-top: 10px;">Temukan Kami</h3>
                <ul class="footer-socmed">
                    <li><a href="#"><i class="fa fa-facebook fa-lg"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter fa-lg"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram fa-lg"></i></a></li>
                </ul>
            </div>
          </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.slim.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    @stack('body.script')
</body>
</html>
