<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ config('app.name') }}</title>
    <!-- Vendor styles -->
    <link rel="stylesheet" href="{{ asset('template/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/vendors/bower_components/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css') }}">

    <!-- App styles -->
    <link rel="stylesheet" href="{{ asset('template/css/app.min.css') }}">
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
                <li><a href="{{ route('dashboard.home.index') }}"><i class="zmdi zmdi-home"></i> Home</a></li>

                @can('access-pelaku-usaha')
                <!-- Menu Pelaku Usaha -->
                <li><a href="{{ route('dashboard.home.index') }}"><i class="zmdi zmdi-home"></i> Permohonan Baru</a></li>
                @endcan

                @can('access-admin')
                <!-- Menu Admin -->
                <li><a href="{{ route('admin.verification.index') }}"><i class="zmdi zmdi-home"></i> Verifikasi Pelaku Usaha</a></li>
                <li><a href="{{ route('admin.users.index') }}"><i class="zmdi zmdi-home"></i> Kelola Pelaku Usaha</a></li>
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
<script src="{{ asset('template/vendors/bower_components/Waves/dist/waves.min.js') }}"></script>
<script src="{{ asset('template/vendors/bower_components/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('template/vendors/bower_components/jquery-scrollLock/jquery-scrollLock.min.js') }}"></script>

<!-- App functions and actions -->
<script src="{{ asset('template/js/app.min.js') }}"></script>
</body>
</html>