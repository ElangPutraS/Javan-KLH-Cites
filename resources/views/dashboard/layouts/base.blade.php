<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <!-- Vendor styles -->
    <link rel="stylesheet"
          href="{{ asset('template/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/vendors/bower_components/animate.css/animate.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('template/vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/vendors/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/vendors/bower_components/flatpickr/dist/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/redactor/redactor.css') }}">
    <link rel="stylesheet" href="{{ asset('js/redactor/alignment.css') }}" >

    <!-- App styles -->
    <link rel="stylesheet" href="{{ asset('template/css/app.min.css') }}">

    <script>
        window.baseUrl = '{{ url('/') }}';
    </script>

    <!-- Demo -->
    <link rel="stylesheet" href="{{ asset('template/demo/css/demo.css') }}">


    @stack('head.stylesheet')
</head>

<body data-ma-theme="green">
<main class="main">
    <div class="page-loader">
        <div class="page-loader__spinner">
            <svg viewBox="25 25 50 50">
                <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
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
                    <a class="dropdown-item" href="{{ route('profile') }}"> <i class="zmdi zmdi-account zmdi-hc-fw"></i>
                        View Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i
                                class="zmdi zmdi-square-right zmdi-hc-fw"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>

            <ul class="navigation">
                <li @if(Request::segment(1)=='dashboard'||Request::segment(2)=='dashboard') class="navigation__active" @endif>
                    <a href="{{ route('dashboard.home.index') }}"><i class="zmdi zmdi-home"></i> Beranda</a></li>

            @can('access-pelaku-usaha')
                @if(auth()->user()->company->company_status >0)
                    <!-- Menu Pelaku Usaha -->
                        <li @if(Request::segment(1)=='companyQuota') class="navigation__active" @endif><a href="{{ route('user.companyQuota.index') }}"><i class="zmdi zmdi-case-check zmdi-hc-fw"></i> Kuota Spesies Perusahaan </a></li>

                        <li @if(Request::segment(1)=='submission'&&Request::segment(2)=='') class="navigation__active" @endif><a href="{{ route('user.submission.index') }}"><i class="zmdi zmdi-collection-text zmdi-hc-fw"></i> Riwayat Permohonan</a></li>

                        <li @if(Request::segment(2)=='create') class="navigation__active" @endif><a href="{{ route('user.submission.create') }}"><i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i> Permohonan SATS-LN</a></li>

                        {{--<li class="navigation__sub @if(Request::segment(1)=='submission') navigation__sub--active navigation__sub--toggled @endif"><a href="{{ route('user.submission.index') }}"><i class="zmdi zmdi-collection-text zmdi-hc-fw"></i>Permohonan SATS-LN</a>
                            <ul>
                                <li @if(Request::segment(1)=='submission'&&Request::segment(2)=='') class="navigation__active" @endif>
                                    <a href="{{ route('user.submission.index') }}"><i
                                                class="zmdi zmdi-collection-text zmdi-hc-fw"></i> Daftar Permohonan</a>
                                </li>
                                <li @if(Request::segment(2)=='create') class="navigation__active" @endif><a
                                            href="{{ route('user.submission.create') }}"><i
                                                class="zmdi zmdi-assignment-o zmdi-hc-fw"></i> Permohonan Langsung</a>
                                </li>
                                <li @if(Request::is('submission/gradually/create')) class="navigation__active" @endif><a
                                            href="{{ route('user.submissionGradually.create') }}"><i
                                                class="zmdi zmdi-assignment zmdi-hc-fw"></i> Permohonan Bertahap</a>
                                </li>
                            </ul>
                        </li>--}}
                        <li @if(Request::segment(1)=='renewal') class="navigation__active" @endif><a href="{{ route('user.renewal.index') }}"><i class="zmdi zmdi-refresh-alt zmdi-hc-fw"></i> Pembaharuan SATS-LN </a></li>

                        <li @if(Request::segment(1)=='invoice') class="navigation__active" @endif><a
                                    href="{{ route('user.invoice.index') }}"><i class="zmdi zmdi-money zmdi-hc-fw"></i>
                                Tagihan SATS-LN </a></li>
                @endif
            @endcan

            @can('access-admin')
                <!-- Menu Admin -->

                    <li @if(Request::segment(2)=='verification') class="navigation__active" @endif><a
                                href="{{ route('admin.verification.index') }}"><i
                                    class="zmdi zmdi-check-all zmdi-hc-fw"></i> Verifikasi Pelaku Usaha</a></li>

                    {{--<li @if(Request::segment(2)=='branch') class="navigation__active" @endif><a href=""><i class="zmdi zmdi-shield-check zmdi-hc-fw"></i> Cabang Pengelola Perizinan</a></li>--}}

                    <li @if(Request::segment(2)=='companyQuota') class="navigation__active" @endif><a
                                href="{{route('admin.companyQuota.index')}}"><i
                                    class="zmdi zmdi-file-plus zmdi-hc-fw"></i> Kelola Kuota Perusahaan</a></li>


                    <li class="navigation__sub @if(Request::segment(2)=='verificationSub' || Request::segment(2)=='verificationRen') navigation__sub--active navigation__sub--toggled @endif">
                        <a href=""><i class="zmdi zmdi-assignment-check zmdi-hc-fw"></i>Verifikasi SATS-LN</a>
                        <ul>
                            <li @if(Request::segment(2)=='verificationSub') class="navigation__active" @endif><a
                                        href="{{ route('admin.verificationSub.index') }}"><i
                                            class="zmdi zmdi-assignment-check zmdi-hc-fw"></i> Verifikasi Permohonan</a>
                            </li>
                            <li @if(Request::segment(2)=='verificationRen') class="navigation__active" @endif><a
                                        href="{{ route('admin.verificationRen.index') }}"><i
                                            class="zmdi zmdi-assignment-check zmdi-hc-fw"></i> Verifikasi
                                    Pembaharuan</a></li>
                        </ul>
                    </li>

                    <li @if(Request::segment(2)=='pnbp') class="navigation__active" @endif><a
                                href="{{ route('admin.pnbp.index') }}"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i>
                            Kelola PNBP</a></li>

                    <li @if(Request::segment(2)=='news') class="navigation__active" @endif><a
                                href="{{ route('admin.news.index') }}"><i class="zmdi zmdi-tv-list zmdi-hc-fw"></i>
                            Kelola Informasi</a></li>

                    <li @if(Request::segment(2)=='percentage') class="navigation__active" @endif><a
                                href="{{ route('admin.percentage.index') }}"><i
                                    class="zmdi zmdi-tv-list zmdi-n-1-square"></i> Kelola Persentase Formula</a></li>

                    <li class="navigation__sub @if(Request::segment(2)=='reportPnbp' || Request::segment(2)=='reportSatsln' || Request::segment(2)=='reportInvestation' || Request::segment(2)=='reportLabor') navigation__sub--active navigation__sub--toggled @endif">
                        <a href=""><i class="zmdi zmdi-book zmdi-hc-fw"></i>Laporan</a>
                        <ul>
                            <li @if(request()->segment(2) == 'reportPnbp') class="navigation__active" @endif><a
                                        href="{{ route('admin.report.pnbp') }}"><i
                                            class="zmdi zmdi-assignment-check zmdi-hc-fw"></i> Laporan PNBP</a></li>
                            <li @if(request()->segment(2) == 'reportSatsln') class="navigation__active" @endif><a
                                        href="{{ route('admin.report.satsln') }}"><i
                                            class="zmdi zmdi-assignment-check zmdi-hc-fw"></i> Laporan SATS-LN</a></li>
                            <li @if(request()->segment(2) == 'reportInvestation') class="navigation__active" @endif><a
                                        href="{{ route('admin.report.investation') }}"><i
                                            class="zmdi zmdi-assignment-check zmdi-hc-fw"></i> Laporan Investasi</a></li>
                            <li @if(request()->segment(2) == 'reportLabor') class="navigation__active" @endif><a
                                        href="{{ route('admin.report.labor') }}"><i
                                            class="zmdi zmdi-assignment-check zmdi-hc-fw"></i> Laporan Serapan Tenaga Kerja</a></li>
                        </ul>
                    </li>

                    <li @if(request()->segment(2) == 'portal-insw') class="navigation__active" @endif><a
                                href="{{ route('admin.report.portalInsw') }}"><i
                                    class="zmdi zmdi-input-antenna zmdi-hc-fw"></i> Portal INSW</a></li>
                @endcan

                @can('access-super-admin')
                <!-- Menu Super Admin -->
                    <li @if(Request::segment(2)=='admin') class="navigation__active" @endif><a
                                href="{{ route('superadmin.index') }}"><i
                                    class="zmdi zmdi-accounts-list zmdi-hc-fw"></i>Kelola User</a></li>

                    <li @if(Request::segment(2)=='verification') class="navigation__active" @endif><a
                                href="{{ route('admin.verification.index') }}"><i
                                    class="zmdi zmdi-check-all zmdi-hc-fw"></i> Verifikasi Pelaku Usaha</a></li>

                    <li @if(Request::segment(2)=='species') class="navigation__active" @endif><a
                                href="{{ route('admin.species.index') }}"><i
                                    class="zmdi zmdi-flower-alt zmdi-hc-fw"></i> Kelola Spesies dan HS</a></li>

                    <li class="navigation__sub @if(Request::segment(2)=='verificationSub' || Request::segment(2)=='verificationRen') navigation__sub--active navigation__sub--toggled @endif">
                        <a href=""><i class="zmdi zmdi-assignment-check zmdi-hc-fw"></i>Verifikasi SATS-LN</a>
                        <ul>
                            <li @if(Request::segment(2)=='verificationSub') class="navigation__active" @endif><a
                                        href="{{ route('admin.verificationSub.index') }}"><i
                                            class="zmdi zmdi-assignment-check zmdi-hc-fw"></i> Verifikasi Permohonan</a>
                            </li>
                            <li @if(Request::segment(2)=='verificationRen') class="navigation__active" @endif><a
                                        href="{{ route('admin.verificationRen.index') }}"><i
                                            class="zmdi zmdi-assignment-check zmdi-hc-fw"></i> Verifikasi
                                    Pembaharuan</a></li>
                        </ul>
                    </li>

                    <li @if(Request::segment(2)=='pnbp') class="navigation__active" @endif><a
                                href="{{ route('admin.pnbp.index') }}"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i>
                            Kelola PNBP</a></li>

                    <li @if(Request::segment(2)=='news') class="navigation__active" @endif><a
                                href="{{ route('admin.news.index') }}"><i class="zmdi zmdi-tv-list zmdi-hc-fw"></i>
                            Kelola Informasi</a></li>

                    <li @if(Request::segment(2)=='percentage') class="navigation__active" @endif><a
                                href="{{ route('admin.percentage.index') }}"><i
                                    class="zmdi zmdi-tv-list zmdi-n-1-square"></i> Kelola Persentase Formula</a></li>

                    <li class="navigation__sub
                        @if(Request::segment(2)=='ports' || Request::segment(2)=='countries' || Request::segment(2)=='provinces' || Request::segment(2)=='cities' || Request::segment(2)=='purposeType' || Request::segment(2)=='typeIdentify' || Request::segment(2)=='category' || Request::segment(2)=='speciesSex' || Request::segment(2)=='appendix' || Request::segment(2)=='source' || Request::segment(2)=='unit')
                            navigation__sub--active navigation__sub--toggled
                        @endif"><a href=""><i class="zmdi zmdi-labels zmdi-hc-fw"></i>Kelola Data Master</a>
                        <ul>
                            <li @if(Request::segment(2)=='ports') class="navigation__active" @endif><a
                                        href="{{ route('admin.ports.index') }}"><i
                                            class="zmdi zmdi-directions-boat zmdi-hc-fw"></i> Kelola Pelabuhan</a></li>
                            <li @if(Request::segment(2)=='countries') class="navigation__active" @endif><a
                                        href="{{ route('admin.countries.index') }}"><i
                                            class="zmdi zmdi-local-airport zmdi-hc-fw"></i> Kelola Negara </a></li>
                            <li @if(Request::segment(2)=='provinces') class="navigation__active" @endif><a
                                        href="{{ route('admin.provinces.index') }}"><i
                                            class="zmdi zmdi-local-parking zmdi-hc-fw"></i> Kelola Provinsi </a></li>
                            <li @if(Request::segment(2)=='cities') class="navigation__active" @endif><a
                                        href="{{ route('admin.cities.index') }}"><i
                                            class="zmdi zmdi-directions-railway zmdi-hc-fw"></i> Kelola Kabupaten/Kota
                                </a></li>
                            <li @if(Request::segment(2)=='purposeType') class="navigation__active" @endif><a
                                        href="{{ route('admin.purposeType.index') }}"><i
                                            class="zmdi zmdi-local-convenience-store zmdi-hc-fw"></i> Kelola Jenis
                                    Kegiatan</a></li>
                            <li @if(Request::segment(2)=='typeIdentify') class="navigation__active" @endif><a
                                        href="{{ route('admin.typeIdentify.index') }}"><i
                                            class="zmdi zmdi-pin-account zmdi-hc-fw"></i> Kelola Tipe Identitas </a>
                            </li>
                            <li @if(Request::segment(2)=='category') class="navigation__active" @endif><a
                                        href="{{ route('admin.species.category') }}"><i
                                            class="zmdi zmdi-nature-people zmdi-hc-fw"></i> Kelola Kategori Spesies</a>
                            </li>
                            <!-- <li @if(Request::segment(2)=='speciesSex') class="navigation__active" @endif><a
                                        href="{{ route('admin.speciesSex.index') }}"><i
                                            class="zmdi zmdi-local-wc zmdi-hc-fw"></i> Kelola Jenis Kelamin Spesies</a>
                            </li> -->
                            <li @if(Request::segment(2)=='appendix') class="navigation__active" @endif><a
                                        href="{{ route('admin.appendix.index') }}"><i
                                            class="zmdi zmdi-layers zmdi-hc-fw"></i> Appendiks</a></li>
                            <li @if(Request::segment(2)=='source') class="navigation__active" @endif><a
                                        href="{{ route('admin.source.index') }}"><i
                                            class="zmdi zmdi-fire zmdi-hc-fw"></i> Sumber Appendiks</a></li>
                            <li @if(Request::segment(2)=='unit') class="navigation__active" @endif><a
                                        href="{{ route('admin.unit.index') }}"><i
                                            class="zmdi zmdi-collection-item zmdi-hc-fw"></i> Satuan Spesies</a></li>
                        </ul>
                    </li>
                    <li class="navigation__sub @if(Request::segment(2)=='reportPnbp' || Request::segment(2)=='reportSatsln') navigation__sub--active navigation__sub--toggled @endif">
                        <a href=""><i class="zmdi zmdi-book zmdi-hc-fw"></i>Laporan</a>
                        <ul>
                            <li @if(request()->segment(2) =='reportPnbp') class="navigation__active" @endif><a
                                        href="{{ route('admin.report.pnbp') }}"><i
                                            class="zmdi zmdi-chart zmdi-hc-fw"></i> Laporan PNBP</a></li>
                            <li @if(request()->segment(2) == 'reportSatsln') class="navigation__active" @endif><a
                                        href="{{ route('admin.report.satsln') }}"><i
                                            class="zmdi zmdi-chart zmdi-hc-fw"></i> Laporan SATS-LN</a></li>
                        </ul>
                    </li>
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
<script src="{{ asset('template/vendors/bower_components/jquery-mask-plugin/dist/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/redactor/redactor.js') }}"></script>
<script src="{{ asset('js/redactor/alignment.js') }}"></script>
<script src="{{ asset('js/redactor/table.js') }}"></script>
<script src="{{ asset('js/redactor/fontsize.js') }}"></script>
<script src="{{ asset('js/redactor/fontcolor.js') }}"></script>
<script src="{{ asset('js/redactor/fontfamily.js') }}"></script>
<script src="{{ asset('js/redactor/underline.js') }}"></script>
<script src="{{ asset('js/redactor/fullscreen.js') }}"></script>


<script type="text/javascript">
    $(function () {
        $('#content-form-news').redactor({
            plugins: ['alignment', 'table', 'fontsize', 'fontcolor', 'fontfamily', 'underline', 'fullscreen']
        });

    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<!-- App functions and actions -->
<script src="{{ asset('template/js/app.min.js') }}"></script>
@stack('body.script')
</body>
</html>