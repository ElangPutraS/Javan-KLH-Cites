@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Daftar Pengajuan SATSL-LN Pengguna</h1>
            </header>

            <div class="card">
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
                                <th width="150px">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $a=0;?>
                            @forelse($trade_permits as $trade_permit)
                            <tr>
                                <td>{{ $a+1 }}</td>
                                <td>{{ $trade_permit->trade_permit_code }}</td>
                                <td>{{ Carbon\Carbon::parse($trade_permit->date_submission)->format('d-m-Y') }}</td>
                                <td>{{ $trade_permit->consignee }}</td>
                                <td>{{ $trade_permit->period }} bulan</td>
                                <td>{{ $trade_permit->portExpor->port_name }}</td>
                                <td>{{ $trade_permit->portDest->port_name  }}</td>
                                <td>{{ $trade_permit->tradeStatus->status_name }}</td>
                                <td>
                                    <a href="" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="" class="btn btn-sm btn-danger">Hapus</a>
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

                    {!! $trade_permits->links() !!}

                </div>
            </div>
        </div>
    </section>
@endsection
