@extends('dashboard.layouts.base')

@section('content')
    <?php
    function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
      }
      return $text;
    }
    ?>

    <section class="content">
        <header class="content__title">
            <h1>Beranda</h1>
        </header>

        <!--div class="card">
            <div class="card-header">
                <h2 class="card-title">Selamat Datang, {{ auth()->user()->name }}</h2>
                <small class="card-subtitle">Anda login sebagai: {{ auth()->user()->roles->first()->role_name }}</small>
            </div>

            <div class="card-block">

            </div>
        </div-->

        @if (auth()->user()->roles->first()->id != 1)

        <div class="card">
            <!--div class="card-block">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="{{ route('dashboard.home.index') }}">Home</a>
                    <span class="breadcrumb-item active">Beranda</span>
                </nav>
            </div-->

            <div class="card-header">
                <h2 class="card-title">Status Permohonan</h2>
            </div>

            <div class="card-block">
                <div class="table-responsive">
                    <table id="data-table" class="table table-condensed table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal Register</th>
                                <th>No. Register</th>
                                <th>Jenis Permohonan</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($tradePermit as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ date('l, d F Y', strtotime($value->date_submission)) }}</td>
                                <td>{{ $value->trade_permit_code }}</td>
                                <td>{{ $value->appendix_type }}</td>
                                <td>{{ $value->tradeStatus->status_name }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">Tidak ada data permohonan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @else

        <div class="row">
            <div class="col-md-4">
                <div class="quick-stats__item bg-blue" style="color: #fff;">
                    <div class="row">
                        <div class="col-sm-10">
                            <h1 style="color: #fff;">{{ $tradePermitAssign }}</h1>
                            <span>Permohonan Diajukan</span>
                        </div>
                        <div class="col-sm-2">
                            <i class="zmdi zmdi-assignment zmdi-hc-5x"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="quick-stats__item bg-amber" style="color: #fff;">
                    <div class="row">
                        <div class="col-sm-10">
                            <h1 style="color: #fff;">{{ $tradePermitAssignCheck }}</h1>
                            <span>Permohonan Terbit</span>
                        </div>
                        <div class="col-sm-2">
                            <i class="zmdi zmdi-assignment-check zmdi-hc-5x"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="quick-stats__item bg-purple" style="color: #fff;">
                    <div class="row">
                        <div class="col-sm-10">
                            <h1 style="color: #fff;">{{ $role }}</h1>
                            <span>Pelaku Usaha</span>
                        </div>
                        <div class="col-sm-2">
                            <i class="zmdi zmdi-assignment-account zmdi-hc-5x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Informasi PNBP</h2>
            </div>

            <div class="card-block">
                <div class="table-responsive">
                    <table id="data-table" class="table table-condensed table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Permohonan</th>
                                <th>Tgl. Terbit SATS-LN</th>
                                <th>Nama Perusahaan</th>
                                <th>Nama Pelaku Usaha</th>
                                <th>Nominal</th>
                                <th>Tgl. Update</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($pnpb as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $value->tradePermit->trade_permit_code }}</td>
                                <td>{{ date('l, d F Y', strtotime($value->tradePermit->valid_start)) }}</td>
                                <td>{{ $value->tradePermit->company->company_name }}</td>
                                <td>{{ $value->tradePermit->consignee }}</td>
                                <td>{{ $value->pnbp_amount }}</td>
                                <td>{{ date('l, d F Y', strtotime($value->updated_at)) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">Tidak ada data PNBP.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @endif

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Informasi Terkini</h2>
            </div>

            <div class="card-block">
                @forelse($news as $key => $value)
                <div class="card @if($key % 2 == 0) card-success card-inverse @else card-primary card-inverse @endif">

                    <div class="card-header">
                        <h2 class="card-title">{{ $value->title }}</h2>
                        <small class="card-subtitle">by <b><i>{{ $value->user->name }}</i></b> at {{ date('l, d F Y', strtotime($value->created_at)) }}</small>
                    </div>

                    <div class="card-block">
                        <p>{{ limit_text($value->content, 50) }}</p>
                        <p><a href="{{ url('news', $value->id) }}" style="color: #fff;" target="_blank"><small>Read more...</small></a></p>
                    </div>

                </div>
                @empty
                <div class="card card-success card-inverse">

                    <div class="card-header">
                        <h2 class="card-title">Admin</h2>
                        <small class="card-subtitle">{{ date('l, d F Y') }}</small>
                    </div>

                    <div class="card-block">
                        <p>Tidak ada informasi terbaru.</p>
                    </div>

                </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('body.script')
    <script src="{{ asset('template/vendors/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/vendors/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template/vendors/bower_components/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('template/vendors/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
@endpush