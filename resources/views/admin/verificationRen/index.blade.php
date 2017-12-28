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

                    @include('includes.notifications')

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-default">
                            <tr>
                                <th width="50px">No</th>
                                <th>Kode Permohonan</th>
                                <th width="150px">Tanggal Dibuat</th>
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
                                    @elseif($trade_permit->tradeStatus->status_code == '100' || $trade_permit->tradeStatus->status_code == '300')
                                        <br>
                                        <small>Tidak diizinkan mencetak</small>
                                    @else
                                        <br>
                                        <small>Blanko sudah dicetak</small>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9"><center>Data Kosong</center></td>
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
