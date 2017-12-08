@extends('dashboard.layouts.base')

@section('content')
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

        <div class="card">
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
                                <td></td>
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

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Informasi Terkini</h2>
            </div>

            <div class="card-block">
                @forelse($news as $key => $value)
                <div class="card @if($key % 2 == 0) card-success card-inverse @else card-primary card-inverse @endif">

                    <div class="card-header">
                        <h2 class="card-title">{{ $value->title }}</h2>
                        <small class="card-subtitle">by {{ $value->user->name }} at {{ date('l, d F Y', strtotime($value->created_at)) }}</small>
                    </div>

                    <div class="card-block">
                        <p>{{ $value->content }}</p>
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