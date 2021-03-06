@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Tagihan SATS-LN</h1>
        </header>

        <div class="card">

            <div class="card-header">
                <h2 class="card-title">Daftar Tagihan SATS-LN</h2>
                <small class="card-subtitle"></small>
            </div>

            <div class="card-block">
                <form method="post" enctype="multipart/form-data" class="form-inline" id="form-search">
                    <div class="input-group col-sm-5">
                        <span class="input-group-addon" id="basic-month">Kode SATS-LN</span>
                        <input class="form-control" type="text" placeholder="Cari kode SATS-LN.." name="trade_permit_code" id="trade_permit_code" value="@if(Request::input('code')){{ Request::input('code') }} @endif">
                    </div>

                    <div class="input-group col-sm-5">
                        <span class="input-group-addon" id="basic-year">Periode</span>
                        <select name="period" id="period" class="form-control select2">
                            <option value="">-- semua --</option>
                            <option value="1" @if(request()->input('period') == 1) selected @endif> 1 bulan</option>
                            <option value="2" @if(request()->input('period') == 2) selected @endif> 2 bulan</option>
                            <option value="3" @if(request()->input('period') == 3) selected @endif> 3 bulan</option>
                            <option value="4" @if(request()->input('period') == 4) selected @endif> 4 bulan</option>
                            <option value="5" @if(request()->input('period') == 5) selected @endif> 5 bulan</option>
                            <option value="6" @if(request()->input('period') == 6) selected @endif> 6 bulan</option>
                        </select>
                    </div>

                    <div class="btn-group col-sm-2" role="group" aria-label="...">
                        <button type="submit" class="btn btn-primary" style="width: 120px;"><i class="fa fa-search"></i> Cari </button>
                    </div>
                    <br><br><br>

                    <div class="input-group col-sm-5">
                        <span class="input-group-addon" id="basic-year">Tanggal Pengajuan (dari)</span>
                        <input class="form-control date-picker flatpickr-input active" placeholder="dari tanggal.." type="text" name="date_from" id="date_from" value="@if(Request::input('date_from')){{Request::input('date_from')}} @endif">
                    </div>

                    <div class="input-group col-sm-5">
                        <span class="input-group-addon" id="basic-year">Tanggal Pengajuan (sampai)</span>
                        <input class="form-control date-picker flatpickr-input active" placeholder="dari tanggal.." type="text" name="date_until" id="date_until" value="@if(Request::input('date_until')){{Request::input('date_until')}} @endif">
                    </div>

                    <div class="btn-group col-sm-2" role="group" aria-label="...">
                        <button type="reset" class="btn btn-danger" id="form-reset" style="width: 120px;"> Reset Pencarian</button>
                    </div>
                </form><br>
                @include('includes.notifications')

                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-default">
                        <tr>
                            <th width="50px">No</th>
                            <th>Kode Permohonan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Penerima</th>
                            <th>Periode</th>
                            <th width="150px">Masa Berlaku</th>
                            <th>Pelabuhan Ekspor</th>
                            <th>Pelabuhan Tujuan</th>
                            <th>Status</th>
                            <th>Jumlah Tagihan</th>
                            <th>Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($trade_permits as $trade_permit)
                            <tr>
                                <td>{{ (($trade_permits->currentPage() - 1 ) * $trade_permits->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $trade_permit->trade_permit_code }}</td>
                                <td>{{ Carbon\Carbon::parse($trade_permit->date_submission)->format('d-m-Y') }}</td>
                                <td>{{ $trade_permit->consignee }}</td>
                                <td>{{ $trade_permit->period }} bulan</td>
                                <td>{{ Carbon\Carbon::parse($trade_permit->valid_start)->format('d-m-Y') }}
                                    sd. {{ Carbon\Carbon::parse($trade_permit->valid_until)->format('d-m-Y') }}</td>
                                <td>{{ $trade_permit->portExpor->port_name }}</td>
                                <td>{{ $trade_permit->portDest->port_name  }}</td>
                                <td>
                                    @if($trade_permit->tradeStatus->status_code==100)
                                        <span class="badge badge-warning">{{ $trade_permit->tradeStatus->status_name }}</span>
                                    @elseif($trade_permit->tradeStatus->status_code==200)
                                        <span class="badge badge-success">{{ $trade_permit->tradeStatus->status_name }}</span>
                                    @elseif($trade_permit->tradeStatus->status_code==300)
                                        <span class="badge badge-danger">{{ $trade_permit->tradeStatus->status_name }}</span>
                                    @else
                                        <span class="badge badge-info">{{ $trade_permit->tradeStatus->status_name }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($trade_permit->pnbp)
                                        Rp. {{ number_format($trade_permit->pnbp->pnbp_amount, 0, ',', '.') }}
                                    @else
                                        <small>Sedang diproses</small>
                                    @endif
                                </td>
                                <td>
                                    @if($trade_permit->pnbp)
                                        <a href="{{route('user.invoice.detail', ['id'=> $trade_permit->id])}}"
                                           class="btn btn-sm btn-info"><i class="zmdi zmdi-book zmdi-hc-fw"
                                                                          title="detail"></i></a>
                                        @else
                                        <small>Sedang diproses</small>
                                        @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11">
                                    <center>Data Kosong</center>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {!! $trade_permits->links('vendor.pagination.bootstrap-4') !!}

            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#form-search').submit(function (ev) {
                ev.preventDefault();

                var code        = $('#trade_permit_code').val();
                var period      = $('#period').val();
                var date_from   = $('#date_from').val();
                var date_until  = $('#date_until').val();

                location.href = '?code=' + code + '&period=' + period + '&date_from=' + date_from+ '&date_until=' + date_until;
            });

            $('#form-reset').click(function (ev) {
                ev.preventDefault();

                location.href = '?code=&period=&date_from=&date_until=';
            });
        });
    </script>
@endpush