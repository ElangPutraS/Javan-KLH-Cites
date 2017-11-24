<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <!-- Vendor styles -->
    <link rel="stylesheet" href="{{ asset('template/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/vendors/bower_components/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/vendors/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/vendors/bower_components/flatpickr/dist/flatpickr.min.css') }}">

    <!-- App styles -->
    <link rel="stylesheet" href="{{ asset('template/css/app.min.css') }}">

    <script>
         window.baseUrl = '{{ url('/') }}';
    </script>

    @stack('head.stylesheet')
</head>

<body data-ma-theme="green">
<main class="main">
    <div class="page-loader">
        <div class="page-loader__spinner">
            <svg viewBox="25 25 50 50">
                <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <header class="header">
        <div class="navigation-trigger hidden-xl-up" data-ma-action="aside-open" data-ma-target=".sidebar">
            <div class="navigation-trigger__inner">
                <i class="navigation-trigger__line"></i>
                <i class="navigation-trigger__line"></i>
                <i class="navigation-trigger__line"></i>
            </div>
        </div>

        <div class="header__logo hidden-sm-down">
            <h1><a href="{{ route('dashboard.home.index') }}">{{ config('app.name') }}</a></h1>
        </div>

        <form class="search">
            <div class="search__inner">
                <input type="text" class="search__text" placeholder="Search for people, files, documents...">
                <i class="zmdi zmdi-search search__helper" data-ma-action="search-close"></i>
            </div>
        </form>

    </header>

    <aside class="sidebar">
        <div class="scrollbar-inner">
            <div class="user">
                <div class="user__info" data-toggle="dropdown">
                    <img class="user__img" src="{{ asset('template/demo/img/profile-pics/8.jpg') }}" alt="">
                    <div>
                        <div class="user__name">{{ auth()->user()->name }}</div>
                        <div class="user__email">{{ auth()->user()->email }}</div>
                    </div>
                </div>

                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('profile') }}">View Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>

            <ul class="navigation">
                <li @if(Request::segment(1)=='dashboard'||Request::segment(2)=='dashboard') class="navigation__active" @endif><a href="{{ route('dashboard.home.index') }}"><i class="zmdi zmdi-home"></i> Beranda</a></li>

                @can('access-pelaku-usaha')
                <!-- Menu Pelaku Usaha -->
                <li class="navigation__sub @if(Request::segment(1)=='submission') navigation__sub--active navigation__sub--toggled @endif"><a href="{{ route('user.submission.index') }}"><i class="zmdi zmdi-collection-text zmdi-hc-fw"></i>Permohonan SATSL-LN</a>
                    <ul>
                        <li @if(Request::segment(1)=='submission'&&Request::segment(2)=='') class="navigation__active" @endif><a href="{{ route('user.submission.index') }}"><i class="zmdi zmdi-collection-text zmdi-hc-fw"></i> Daftar Permohonan</a></li>
                        <li @if(Request::segment(2)=='createDirect') class="navigation__active" @endif><a href="{{ route('user.submission.showDirect') }}"><i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i> Permohonan Langsung</a></li>
                        <li @if(Request::segment(2)=='createStage') class="navigation__active" @endif><a href="{{ route('dashboard.home.index') }}"><i class="zmdi zmdi-assignment zmdi-hc-fw"></i> Permohonan Bertahap</a></li>
                    </ul>
                </li>
                @endcan

                @can('access-admin')
                <!-- Menu Admin -->
                <li @if(Request::segment(2)=='verification') class="navigation__active" @endif><a href="{{ route('admin.verification.index') }}"><i class="zmdi zmdi-check-all zmdi-hc-fw"></i> Verifikasi Pelaku Usaha</a></li>
                <li @if(Request::segment(2)=='companies') class="navigation__active" @endif><a href="{{ route('admin.companies.index') }}"><i class="zmdi zmdi-accounts-list zmdi-hc-fw"></i> Kelola Pelaku Usaha</a></li>
                <li @if(Request::segment(2)=='category') class="navigation__active" @endif><a href="{{ route('admin.species.category') }}"><i class="zmdi zmdi-nature-people zmdi-hc-fw"></i> Kelola Kategori Spesies</a></li>
                <li @if(Request::segment(2)=='species') class="navigation__active" @endif><a href="{{ route('admin.species.index') }}"><i class="zmdi zmdi-flower-alt zmdi-hc-fw"></i> Kelola Spesies dan HS</a></li>
                <li @if(Request::segment(2)=='ports') class="navigation__active" @endif><a href="{{ route('admin.ports.index') }}"><i class="zmdi zmdi-directions-boat zmdi-hc-fw"></i> Kelola Pelabuhan</a></li>
                <li @if(Request::segment(2)=='news') class="navigation__active" @endif><a href="{{ route('admin.news.index') }}"><i class="zmdi zmdi-tv-list zmdi-hc-fw"></i> Kelola Informasi</a></li>
                @endcan
            </ul>
        </div>
    </aside>

    @yield('content')

</main>

<!-- Javascript -->
<!-- Vendors -->
<script src="{{ asset('template/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('template/vendors/bower_components/tether/dist/js/tether.min.js') }}"></script>
<script src="{{ asset('template/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('template/vendors/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('template/vendors/bower_components/Waves/dist/waves.min.js') }}"></script>
<script src="{{ asset('template/vendors/bower_components/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('template/vendors/bower_components/jquery-scrollLock/jquery-scrollLock.min.js') }}"></script>
<script src="{{ asset('template/vendors/bower_components/flatpickr/dist/flatpickr.min.js') }}"></script>
<script src="{{ asset('template/vendors/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<!-- App functions and actions -->
<script src="{{ asset('template/js/app.min.js') }}"></script>

@stack('body.script')
</body>
</html>