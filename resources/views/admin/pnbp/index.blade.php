@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Penerimaan Negara Bukan Pajak (PNBP)</h1>
            </header>

            <div class="card">

                <div class="card-header">
                    <h2 class="card-title">Daftar PNBP Permohonan SATS-LN</h2>
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
                                <th>No PNBP</th>
                                <th>Perusahaan</th>
                                <th width="150px">Masa Berlaku</th>
                                <th>Status</th>
                                <th>IHH</th>
                                <th>EA-EB</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $a=1;?>
                            @forelse($trade_permits as $trade_permit)
                            <tr>
                                <td>{{ (($trade_permits->currentPage() - 1 ) * $trade_permits->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $trade_permit->trade_permit_code }}</td>
                                <td>
                                    @if($trade_permit->pnbp !== null)
                                        {{ $trade_permit->pnbp->pnbp_code }}
                                    @else
                                        PNBP belum dibuat
                                    @endif
                                </td>
                                <td>{{ $trade_permit->company->company_name }}</td>
                                <td>{{ Carbon\Carbon::parse($trade_permit->valid_start)->format('d-m-Y').' sd. '.Carbon\Carbon::parse($trade_permit->valid_until)->format('d-m-Y') }}</td>
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
                                    <br>
                                    Tagihan : 
                                        @if($trade_permit->pnbp !== null)
                                            @if($trade_permit->pnbp->payment_status == 0)
                                                Belum Lunas
                                            @else
                                                Sudah Lunas
                                            @endif
                                        @else
                                            Belum Lunas
                                        @endif
                                </td>
                                <td>
                                    <?php
                                        $jumlah=0;
                                        foreach ($trade_permit->tradeSpecies as $species) {
                                            if($trade_permit->permit_type == 1){
                                                $jumlah = $jumlah + ($species->pivot->total_exported * $species->nominal);
                                            }
                                        }
                                        echo 'Rp. '.number_format($jumlah,2,',','.');

                                        $jumlah = $jumlah + 100000;
                                    ?>
                                </td>
                                <td> Rp. {{ number_format(100000,2,',','.') }} </td>
                                <td> Rp. {{ number_format($jumlah,2,',','.') }} </td>
                                <td>
                                    <a href="{{route('admin.pnbp.create', ['id' => $trade_permit->id])}}" class="btn btn-sm btn-primary" title="Buat PNBP">PNBP</a><br><br>
                                    <a href="{{route('admin.pnbp.payment', ['id' => $trade_permit->id])}}" class="btn btn-sm btn-success" title="Bayar Tagihan">Bayar</a>
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
