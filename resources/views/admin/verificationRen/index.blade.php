@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Permohonan Pembaharuan SATS-LN Pengguna</h1>
            </header>

            <div class="card">

                <div class="card-header">
                    <h2 class="card-title">Daftar Permohonan Pembaharuan SATS-LN Pengguna</h2>
                    <small class="card-subtitle"></small>
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
                            <span class="input-group-addon" id="basic-year">Status</span>
                            <select name="status" id="status" class="form-control select2">
                                <option value="">-- semua --</option>
                                @foreach($status as $stat)
                                    <option value="{{ $stat->id }}" @if(request()->input('status') == $stat->id) selected @endif> {{ $stat->status_name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group col-sm-3">
                            <span class="input-group-addon" id="basic-year">Tanggal Dibuat (dari)</span>
                            <input class="form-control date-picker flatpickr-input active" placeholder="dari tanggal.." type="text" name="date_from" id="date_from" value="@if(Request::input('date_from')){{Request::input('date_from')}} @endif">
                        </div>

                        <div class="input-group col-sm-3">
                            <span class="input-group-addon" id="basic-year">Tanggal Dibuat (sampai)</span>
                            <input class="form-control date-picker flatpickr-input active" placeholder="sampai tanggal.." type="text" name="date_until" id="date_until" value="@if(Request::input('date_until')){{Request::input('date_until')}} @endif">
                        </div>

                        <div class="btn-group col-sm-1" role="group" aria-label="...">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari
                            </button>
                        </div>
                    </form><br>
                    @include('includes.notifications')

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-default">
                            <tr>
                                <th width="50px">No</th>
                                <th>Kode Permohonan</th>
                                <th width="120px">Tanggal Dibuat</th>
                                <th>Nama Perusahaan</th>
                                <th>Penerima</th>
                                <th>Periode</th>
                                <th>Pelabuhan Ekspor</th>
                                <th>Pelabuhan Tujuan</th>
                                <th>Status</th>
                                <th>Detail</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($trade_permits as $trade_permit)
                            <tr>
                                <td>{{ (($trade_permits->currentPage() - 1 ) * $trade_permits->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $trade_permit->trade_permit_code }}</td>
                                <td>{{ Carbon\Carbon::parse($trade_permit->date_submission)->format('d-m-Y') }}</td>
                                <td>{{ $trade_permit->company->company_name }}</td>
                                <td>{{ $trade_permit->consignee }}</td>
                                <td>{{ $trade_permit->period }} bulan</td>
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
                                    <a href="{{route('admin.verificationRen.show', ['id'=> $trade_permit->id])}}" class="btn btn-sm btn-info"><i class="zmdi zmdi-book zmdi-hc-fw" title="detail"></i></a>
                                    @if ($trade_permit->tradeStatus->status_code == '200' && $trade_permit->permit_type == 2 && $trade_permit->is_printed == 0)
                                        <a href="{{route('admin.report.printSatsln', ['id'=> $trade_permit->id])}}"
                                           class="btn btn-sm btn-info @if($trade_permit->is_blanko == 1) print @else printed @endif" target="_blank"
                                           data-id="{{ $trade_permit->id }}"><i
                                                    class="zmdi zmdi-print zmdi-hc-fw" title="print"></i></a>
                                    @elseif($trade_permit->tradeStatus->status_code == '200' && $trade_permit->is_printed == 1)
                                        <br>
                                        <small>Blanko sudah dicetak</small>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10"><center>Data Kosong</center></td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    {!! $trade_permits->links('vendor.pagination.bootstrap-4') !!}

                </div>
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
                var company_name= $('#company_name').val();
                var status      = $('#status').val();
                var date_from   = $('#date_from').val();
                var date_until  = $('#date_until').val();

                location.href = '?code=' + code + '&company_name=' + company_name+ '&status=' + status+ '&date_from=' + date_from+ '&date_until=' + date_until;
            });
        });

        $('.printed').click(function () {
            printBtn = $(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: window.baseUrl + '/admin/store-is-printed',
                type: 'post',
                data: {id: printBtn.data('id'), is_printed: 1},
                success: function (result) {
                    if (result == 'true') {
                        //window.location = window.baseUrl + '/admin/verificationSub'
                    } else {
                        return false;
                    }
                },
                error: function (xhr) {

                }
            });
        });

        $('.print').click(function () {
            printBtn = $(this);

            swal({
                title: 'Apakah anda yakin?',
                text: 'Akan mencetak laporan ini?',
                type: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then(function () {
                swal({
                    title: 'Masukan Security Stamp',
                    input: 'text',
                    showCancelButton: true,
                    confirmButtonText: 'Cetak',
                    showLoaderOnConfirm: true,
                    allowOutsideClick: false
                }).then(function (value) {
                    if (value === false || value === '') {
                        swal('Security stamp harus diisi.');

                        return false;
                    } else {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: window.baseUrl + '/admin/store-stamp-satsln',
                            type: 'post',
                            data: {id: printBtn.data('id'), stamp: value},
                            success: function (result) {
                                if (result == 'true') {
                                    swal('Data berhasil di stamp.').then(function () {
                                        swal({
                                            type: 'success',
                                            title: 'Cetak laporan sedang diproses'
                                        }).then(function () {
                                            window.open($('.print').attr('href'), '_blank');
                                        });
                                    });
                                } else {
                                    swal('Data tidak berhasil di stamp.');

                                    return false;
                                }
                            },
                            error: function (xhr) {
                                swal('Data tidak berhasil di stamp.');

                                return false;
                            },
                            complete: function () {
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    url: window.baseUrl + '/admin/store-is-printed',
                                    type: 'post',
                                    data: {id: printBtn.data('id'), is_printed: 1},
                                    success: function (result) {
                                        if (result == 'true') {
                                            //window.location = window.baseUrl + '/admin/verificationSub'
                                        } else {
                                            return false;
                                        }
                                    },
                                    error: function (xhr) {

                                    }
                                });
                            }
                        });
                    }
                });
            });

            return false;
        });
    </script>
    @endpush
