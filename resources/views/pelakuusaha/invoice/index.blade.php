@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Tagihan SATS-LN</h1>
            </header>

            <div class="card">

                <div class="card-header">
                    <h2 class="card-title">Daftar Tagihan SATS-LN</h2>
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
                                <th>Tanggal Pengajuan</th>
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
                                    <td colspan="9">
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
        </div>
    </section>
@endsection
