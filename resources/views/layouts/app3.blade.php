<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/small-business.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/html5shiv.js') }}"></script>
    <script src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('images/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        window.baseUrl = '{{ url('/') }}';
    </script>

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="klh-navbar">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/Lambang_Kementerian_Lingkungan_Hidup_dan_Kehutanan.png') }}">
                <span>E-SATS-LN</span>
                <span>KEMENTERIAN LINGKUNGAN HIDUP DAN KEHUTANAN</span>
                <span>REPUBLIK INDONESIA</span>
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li @if(Request::is('/')) class="klh-active" @endif><a aria-expanded="false" role="button"
                                                                       href="{{ url('/') }}">Beranda</a></li>
                <!-- Authentication Links -->
                @guest
                    <li @if(Request::is('login')) class="klh-active" @endif><a
                                href="{{ route('login') }}">Masuk</a></li>
                    <li @if(Request::is('register')) class="klh-active" @endif><a
                                href="{{ route('register') }}">Mendaftar</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false" aria-haspopup="true">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('profile') }}">
                                    Profil
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
	                                                     document.getElementById('logout-form').submit();">
                                    Keluar
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
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">
    <!-- Heading Row -->
    <div class="row">
        <div class="col-md-8">
            <div class="carousel slide" id="carousel1">
                <div class="carousel-inner">
                    <div class="item active">
                        <img alt="image" class="img-responsive"
                             src="{{ asset('images/twilight-forest-wallpaperrr.jpg') }}">
                    </div>
                    <div class="item">
                        <img alt="image" class="img-responsive" src="{{ asset('images/Forest-Wallpapersss.jpg') }}">
                    </div>
                </div>
                <a data-slide="prev" href="#carousel1" class="left carousel-control">
                    <span class="icon-prev"></span>
                </a>
                <a data-slide="next" href="#carousel1" class="right carousel-control">
                    <span class="icon-next"></span>
                </a>
            </div>
        </div>
        <!-- /.col-md-8 -->
        <div class="col-md-4">
            <h1>KLHK E-SATS-LN</h1>
            <p>SATS-LN adalah surat angkut dari Kementerian Kehutanan untuk Tumbuhan Alam dan Satwa Liar yang tidak
                dilindungi Undang-Undang dan termasuk dalam daftar CITES.</p>
            @guest
                <a class="btn btn-success btn-lg" href="{{ route('login') }}">Masuk</a>
            @else
                <a class="btn btn-danger btn-lg" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
	                                                     document.getElementById('logout-form').submit();">
                    Keluar
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                </form>
            @endguest
        </div>
        <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->
</div>

<hr>

@yield('content')
<!-- /.container -->

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6" id="footer-1">
                <img src="{{ asset('images/Lambang_Kementerian_Lingkungan_Hidup_dan_Kehutanan.png') }}">
                <span>E-SATS-LN</span>
                <span>KEMENTERIAN LINGKUNGAN HIDUP DAN KEHUTANAN</span>
                <span>REPUBLIK INDONESIA</span>
                <span>www.menlhk.go.id - Copyright &copy; 2017</span>
            </div>

            <div class="col-md-4" id="footer-2">
                <span>Hubungi Kami</span>
                <ul>
                    <li>
                        <div><i class="fa fa-home"></i></div>
                        <div>Gedung Manggala Wanabhakti, Blok VII Lt. 7<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jl.
                            Gatot
                            Subroto, Senayan, Jakarta Pusat, 10270
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li>
                        <div><i class="fa fa-phone"></i></div>
                        <div>Telepon: (62-21) 5720227, 5704501-04<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ext. 769
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li>
                        <div><i class="fa fa-fax"></i></div>
                        <div>Fax: (62-21) 5720227, 5734818</div>
                        <div class="clearfix"></div>
                    </li>
                    <li>
                        <div><i class="fa fa-envelope-o"></i></div>
                        <div>E-Mail: <a href="mailto:ditkkh@gmail.com">ditkkh@gmail.com</a></div>
                        <div class="clearfix"></div>
                    </li>
                </ul>
            </div>

            <div class="col-md-2" id="footer-3">
                <span>Temukan Kami</span>
                <ul>
                    <li><a href="#"><i class="fa fa-facebook fa-2x"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter fa-2x"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram fa-2x"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="{{ asset('js/jquery-3.2.1.slim.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

</body>

</html>
