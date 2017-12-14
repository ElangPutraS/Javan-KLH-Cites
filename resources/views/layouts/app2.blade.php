<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/klh-style.css') }}">
    <script>
        window.baseUrl = '{{ url('/') }}';
    </script>
</head>
<body class="top-navigation">
<div id="wrapper" class="container">
    <div id="page-wrapper" class="gray-bg">
        <div class="row white-bg">
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-header">
                    <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse"
                            class="navbar-toggle collapsed" type="button">
                        <i class="fa fa-reorder"></i>
                    </button>
                    <a href="{{ url('/') }}" class="navbar-brand">
                        <img src="{{ asset('images/CITES_logo_high_resolution_white.png') }}">
                        <img src="{{ asset('images/Lambang_Kementerian_Lingkungan_Hidup_dan_Kehutanan.png') }}">
                        <span>KEMENTERIAN LINGKUNGAN HIDUP</span>
                        <span>REPUBLIK INDONESIA</span>
                    </a>
                </div>
                <div class="navbar-collapse collapse" id="navbar">
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
                </div>
            </nav>
        </div>

        @yield('content')

        <div class="row footer">
            <div class="col-sm-4">
                <img src="{{ asset('images/CITES_logo_high_resolution_white.png') }}">
                <img src="{{ asset('images/Lambang_Kementerian_Lingkungan_Hidup_dan_Kehutanan.png') }}">
                <br>
                <span>KEMENTERIAN LINGKUNGAN HIDUP</span>
                <br>
                <span>REPUBLIK INDONESIA</span>
                <br>
                <span>www.menlh.go.id - Copyright &copy; 2017</span>
                <!--p class="text-muted">Place sticky footer content here.</p-->
            </div>

            <div class="col-sm-5">
                <h3>Hubungi Kami</h3>
                <ul id="klh-call-us">
                    <li>
                        <div><i class="fa fa-home"></i></div>
                        <div>Kementerian Lingkungan Hidup dan Kehutanan Gedung Manggala Wanabakti Blok I Lt.2<br>Jl.Gatot
                            Subroto, Senayan, Jakarta Pusat
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li>
                        <div><i class="fa fa-phone"></i></div>
                        <div>Telepon: +62 (21) 8580067-68</div>
                        <div class="clearfix"></div>
                    </li>
                </ul>
            </div>

            <div class="col-sm-3">
                <h3>Temukan Kami</h3>
                <ul id="klh-find-us">
                    <li><a href="#"><i class="fa fa-facebook fa-2x"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter fa-2x"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram fa-2x"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Mainly scripts -->
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('inspinia/js/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('inspinia/js/jquery.slimscroll.min.js') }}"></script>
<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia/js/inspinia.js') }}"></script>
<script src="{{ asset('inspinia/js/pace.min.js') }}"></script>
<script type="text/javascript"
        src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
@stack('body.script')
</body>
</html>