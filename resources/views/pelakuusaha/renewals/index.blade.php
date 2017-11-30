@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Permohonan SATSL-LN Pengguna</h1>
            </header>

            <div class="card">

                <div class="card-header">
                    <h2 class="card-title">Daftar Permohonan SATSL-LN Pengguna</h2>
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
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $a = 1;?>
                            @forelse($trade_permits as $trade_permit)
                                <tr>
                                    <td><?=$a++?></td>
                                    <td>{{ $trade_permit -> trade_permit_code }}</td>
                                    <td>{{ Carbon\Carbon::parse($trade_permit -> date_submission) -> format('d-m-Y') }}</td>
                                    <td>{{ $trade_permit -> consignee }}</td>
                                    <td>{{ $trade_permit -> period }} bulan</td>
                                    <td>{{ $trade_permit -> portExpor -> port_name }}</td>
                                    <td>{{ $trade_permit -> portDest -> port_name  }}</td>
                                    <td>
                                        @if($trade_permit -> tradeStatus -> status_code == 100)
                                            <span class = "badge badge-warning">{{ $trade_permit -> tradeStatus -> status_name }}</span>
                                        @elseif($trade_permit -> tradeStatus -> status_code == 200)
                                            <span class = "badge badge-success">{{ $trade_permit -> tradeStatus -> status_name }}</span>
                                        @elseif($trade_permit -> tradeStatus -> status_code == 300)
                                            <span class="badge badge-danger">{{ $trade_permit -> tradeStatus -> status_name }}</span>
                                        @else
                                            <span class="badge badge-info">{{ $trade_permit -> tradeStatus -> status_name }}</span>
                                        @endif
                                    </td>
                                    <td><a href="{{route('user.renewal.edit', ['id' => $trade_permit -> id])}}" class="btn btn-sm btn-info @if($trade_permit -> valid_renewal >=2){{'disabled'}} @endif" ><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9"><center>Data Kosong</center></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    {!! $trade_permits -> links() !!}

                </div>
            </div>
        </div>
    </section>
@endsection
