@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Daftar Pengajuan SATLN-LS Pengguna</h1>
            </header>

            <div class="card">
                <div class="card-block">

                    @include('includes.notifications')

                    <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">Tambah Baru</a>

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
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">Data Kosong</td>
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