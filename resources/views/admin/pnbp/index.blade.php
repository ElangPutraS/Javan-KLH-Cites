@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Penerimaan Negara Bukan Pajak (PNBP)</h1>
            </header>

            <div class="card">

                <div class="card-header">
                    <h2 class="card-title">Daftar PNBP Permohonan SATLS-LN</h2>
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
                                <th>Perusahaan</th>
                                <th width="150px">Masa Berlaku</th>
                                <th>Jenis Permohonan</th>
                                <th>Pelabuhan Ekspor</th>
                                <th>Pelabuhan Tujuan</th>
                                <th>Status</th>
                                <th>Nominal PNBP</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $a=1;?>
                            @forelse($trade_permits as $trade_permit)
                            <tr>
                                <td>{{ (($trade_permits->currentPage() - 1 ) * $trade_permits->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $trade_permit->trade_permit_code }}</td>
                                <td>{{ $trade_permit->company->company_name }}</td>
                                <td>{{ Carbon\Carbon::parse($trade_permit->valid_start)->format('d-m-Y').' sd. '.Carbon\Carbon::parse($trade_permit->valid_until)->format('d-m-Y') }}</td>
                                <td>
                                    @if($trade_permit->period<6)
                                        Permohonan Bertahap
                                    @else
                                        Permohonan Langsung
                                    @endif
                                </td>
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
                                    @if(count($trade_permit->pnbp)<=0)
                                        Rp 0
                                    @else
                                        Rp number_format($trade_permit->pnbp->pnbp_amount,2,',','.');
                                    @endif
                                </td>
                                <td><a href="{{route('admin.pnbp.edit', ['id' => $trade_permit->id])}}" class="btn btn-sm btn-primary"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10"><center>Data Kosong</center></td>
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
