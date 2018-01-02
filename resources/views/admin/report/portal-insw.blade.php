@extends('dashboard.layouts.base')

@section('content')
    <div class="row">
        <section class="content col-sm-12">
            <div class="content__inner">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Portal INSW</h2>
                        <small class="card-subtitle">List SATS-LN/Permohonan Terbit</small>
                    </div>

                    <div class="card-block">
                        <form method="post" enctype="multipart/form-data" class="form-inline" id="form-search">
                            <div class="input-group col-sm-5">
                                <span class="input-group-addon" id="basic-month">Kode SATS-LN</span>
                                <input class="form-control" type="text" placeholder="Cari kode SATS-LN.." name="trade_permit_code" id="trade_permit_code" value="@if(Request::input('code')){{Request::input('code')}} @endif">
                            </div>

                            <div class="input-group col-sm-6">
                                <span class="input-group-addon" id="basic-month">Nama Perusahaan</span>
                                <input class="form-control" type="text" placeholder="Cari nama perusahaan.." name="company_name" id="company_name" value="@if(Request::input('company_name')){{Request::input('company_name')}} @endif">
                            </div><br><br><br>

                            <div class="input-group col-sm-5">
                                <span class="input-group-addon" id="basic-year">Masa Berlaku (dari)</span>
                                <input class="form-control date-picker flatpickr-input active" placeholder="dari tanggal.." type="text" name="date_from" id="date_from" value="@if(Request::input('date_from')){{Request::input('date_from')}} @endif">
                            </div>

                            <div class="input-group col-sm-6">
                                <span class="input-group-addon" id="basic-year">Masa Berlaku (sampai)</span>
                                <input class="form-control date-picker flatpickr-input active" placeholder="sampai tanggal.." type="text" name="date_until" id="date_until" value="@if(Request::input('date_until')){{Request::input('date_until')}} @endif">
                            </div>

                            <div class="btn-group col-sm-1" role="group" aria-label="...">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari
                                </button>
                            </div>
                        </form><br>

                        <div class="table-responsive">
                            <table class="table table-condensed table-hover table-striped">
                                <thead align="center">
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Permohonan</th>
                                    <th>Masa Berlaku</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Penerima</th>
                                    <th>Periode</th>
                                    <th>Pelabuhan Ekspor</th>
                                    <th>Pelabuhan Tujuan</th>
                                    <th>Maksud Transaksi</th>
                                    <th>Jumlah Spesies</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse($tradePermit as $tradePermits)
                                    <tr>
                                        <td align="center">{{ $loop->iteration }}</td>
                                        <td align="center">{{ $tradePermits->trade_permit_code }}</td>
                                        <td align="center"><small>{{ date('l, d F Y', strtotime($tradePermits->valid_until)) }}</small></td>
                                        <td align="center">{{ $tradePermits->company->company_name }}</td>
                                        <td align="center">{{ $tradePermits->consignee }}</td>
                                        <td align="center">{{ $tradePermits->period }}</td>
                                        <td align="center">{{ $tradePermits->portExpor->port_name }}</td>
                                        <td align="center">{{ $tradePermits->portDest->port_name }}</td>
                                        <td align="center">{{ $tradePermits->purposeType->purpose_type_name }}</td>
                                        <td align="center">{{ $tradePermits->tradePermit->tradeSpecies->groupBy('id')->count()}}</td>
                                        <td align="center">
                                            <a class="btn btn-success btn-sm" href="{{ route('admin.report.sendInsw', ['tradePermitId' => $tradePermits->id]) }}" target="_blank"><i class="zmdi zmdi-mail-send"></i> Kirim</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">Tidak ada data SATS-LN/Permohonan</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        {!! $tradePermit->appends(\Illuminate\Support\Facades\Input::except('page'))->render('vendor.pagination.bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#form-search').submit(function (ev) {
                ev.preventDefault();

                var code        = $('#trade_permit_code').val();
                var company_name= $('#company_name').val();
                var date_from   = $('#date_from').val();
                var date_until  = $('#date_until').val();

                location.href = '?code=' + code + '&company_name=' + company_name+ '&date_from=' + date_from+ '&date_until=' + date_until;
            });
        });

    </script>
@endpush
