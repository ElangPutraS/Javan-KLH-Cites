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
            <h1><a href="index.html">{{ config('app.name') }}</a></h1>
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
                    <img class="user__img" src="{{ asset('templates/demo/img/profile-pics/8.jpg') }}" alt="">
                    <div>
                        <div class="user__name">Malinda Hollaway</div>
                        <div class="user__email">malinda-h@gmail.com</div>
                    </div>
                </div>

                <div class="dropdown-menu">
                    <a class="dropdown-item" href="">View Profile</a>
                    <a class="dropdown-item" href="">Settings</a>
                    <a class="dropdown-item" href="">Logout</a>
                </div>
            </div>

            <ul class="navigation">
                <li><a href="index.html"><i class="zmdi zmdi-home"></i> Home</a></li>

                <li class="navigation__sub">
                    <a href=""><i class="zmdi zmdi-view-week"></i> Variants</a>

                    <ul>
                        <li><a href="hidden-sidebar.html">Hidden Sidebar</a></li>
                        <li><a href="boxed-layout.html">Boxed Layout</a></li>
                        <li><a href="hidden-sidebar-boxed-layout.html">Boxed Layout with Hidden Sidebar</a></li>
                        <li><a href="top-navigation.html">Top Navigation</a></li>
                    </ul>
                </li>

                <li><a href="typography.html"><i class="zmdi zmdi-format-underlined"></i> Typography</a></li>

            </ul>
        </div>
    </aside>

    <aside class="chat">
        <div class="chat__header">
            <h2 class="chat__title">Chat <small>Currently 20 contacts online</small></h2>

            <div class="chat__search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search...">
                    <i class="form-group__bar"></i>
                </div>
            </div>
        </div>

        <div class="listview listview--hover chat__buddies scrollbar-inner">
            <a class="listview__item chat__available">
                <img src="demo/img/profile-pics/7.jpg" class="listview__img" alt="">

                <div class="listview__content">
                    <div class="listview__heading">Jeannette Lawson</div>
                    <p>hey, how are you doing.</p>
                </div>
            </a>

        </div>

        <a href="messages.html" class="btn btn--action btn--fixed btn-danger"><i class="zmdi zmdi-plus"></i></a>
    </aside>

    <section class="content">
        <header class="content__title">
            <h1>xxx</h1>

            <div class="actions">
                <a href="" class="actions__item zmdi zmdi-trending-up"></a>
                <a href="" class="actions__item zmdi zmdi-check-all"></a>

                <div class="dropdown actions__item">
                    <i data-toggle="dropdown" class="zmdi zmdi-more-vert"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="" class="dropdown-item">Refresh</a>
                        <a href="" class="dropdown-item">Manage Widgets</a>
                        <a href="" class="dropdown-item">Settings</a>
                    </div>
                </div>
            </div>
        </header>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">xxx</h2>
                <small class="card-subtitle">xxx</small>
            </div>

            <div class="card-block">

            </div>
        </div>

        <footer class="footer hidden-xs-down">
            <p>Material Admin Responsive. All rights reserved.</p>

            <ul class="nav footer__nav">
                <a class="nav-link" href="">Homepage</a>

                <a class="nav-link" href="">Company</a>

                <a class="nav-link" href="">Support</a>

                <a class="nav-link" href="">News</a>

                <a class="nav-link" href="">Contacts</a>
            </ul>
        </footer>
    </section>
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