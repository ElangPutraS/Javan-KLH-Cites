@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Kelola Penerimaan Negara Bukan Pajak (PNBP)</h1>
        </header>

        <div class="card">

            <div class="card-header">
                <h2 class="card-title">Daftar PNBP Permohonan SATS-LN</h2>
                <small class="card-subtitle"></small>
            </div>

            <div class="card-block">
                <form method="post" enctype="multipart/form-data" class="form-inline" id="form-search">
                    <div class="input-group col-sm-4">
                        <span class="input-group-addon" id="basic-month">Kode SATS-LN</span>
                        <input class="form-control" type="text" placeholder="Cari kode SATS-LN.." name="trade_permit_code" id="trade_permit_code" value="@if(Request::input('trade_permit_code')){{Request::input('trade_permit_code')}} @endif">
                    </div>

                    <div class="input-group col-sm-6">
                        <span class="input-group-addon" id="basic-year">No PNBP</span>
                        <input class="form-control" placeholder="Cari no pnbp.." type="text" name="pnbp_code" id="pnbp_code" value="@if(Request::input('pnbp_code')){{Request::input('pnbp_code')}} @endif">
                    </div>

                    <div class="btn-group col-sm-2" role="group" aria-label="...">
                        <button type="submit" class="btn btn-primary" style="width: 120px;"><i class="fa fa-search"></i> Cari </button>
                    </div>
                    <br><br><br>

                    <div class="input-group col-sm-4">
                        <span class="input-group-addon" id="basic-month">Nama Perusahaan</span>
                        <input class="form-control" type="text" placeholder="Cari nama perusahaan.." name="company_name" id="company_name" value="@if(Request::input('company_name')){{Request::input('company_name')}} @endif">
                    </div>

                    <div class="input-group col-sm-3">
                        <span class="input-group-addon" id="basic-year">Tanggal Mulai Validasi (dari)</span>
                        <input class="form-control date-picker flatpickr-input active" placeholder="dari tanggal.." type="text" name="date_from" id="date_from" value="@if(Request::input('date_from')){{Request::input('date_from')}} @endif">
                    </div>

                    <div class="input-group col-sm-3">
                        <span class="input-group-addon" id="basic-year">Tanggal Mulai Validasi (sampai)</span>
                        <input class="form-control date-picker flatpickr-input active" placeholder="sampai tanggal.." type="text" name="date_until" id="date_until" value="@if(Request::input('date_until')){{Request::input('date_until')}} @endif">
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
                            <th>Jenis Permohonan</th>
                            <th>Kode Permohonan</th>
                            <th>No PNBP</th>
                            <th>Perusahaan</th>
                            <th width="150px">Masa Berlaku</th>
                            <th>Status</th>
                            <th>IHH</th>
                            <th>EA-EB</th>
                            <th>Nilai Persentase</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $a = 1;?>
                        @forelse($trade_permits as $trade_permit)
                            <tr>
                                <td>{{ (($trade_permits->currentPage() - 1 ) * $trade_permits->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $trade_permit->permit_type == 1 ? 'Permohonan' : 'Pembaharuan' }}</td>
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
                                    @if($trade_permit->pnbp)
                                        {{ 'Rp. '.number_format($trade_permit->pnbp->pnbp_sub_amount, 2, ',', '.') }}
                                    @else
                                        @php
                                            $jumlah=0;
                                            foreach ($trade_permit->tradeSpecies as $species) {
                                                if($trade_permit->permit_type == 1){
                                                    $jumlah = $jumlah + ($species->pivot->total_exported * $species->nominal);
                                                }
                                            }
                                            echo 'Rp. '.number_format($jumlah, 2, ',', '.');

                                            $jumlah = $jumlah + 100000;
                                        @endphp
                                    @endif
                                </td>
                                <td>Rp. {{ number_format(100000, 2, ',', '.') }}</td>
                                <td>
                                    @if($trade_permit->pnbp)
                                        {{ 'Rp. '.number_format($trade_permit->pnbp->pnbp_percentage_amount, 2, ',', '.') }}
                                    @else
                                        Rp. 0
                                    @endif
                                </td>
                                <td>
                                    @if($trade_permit->pnbp)
                                        {{ 'Rp. '.number_format($trade_permit->pnbp->pnbp_amount, 2, ',', '.') }}
                                    @else
                                        Rp. {{ number_format($jumlah,2,',','.') }}
                                    @endif
                                </td>
                                <td>
                                    @if($trade_permit->pnbp)
                                        <a href="{{route('admin.pnbp.payment', ['id' => $trade_permit->id])}}"
                                           class="btn btn-sm btn-success" title="Bayar Tagihan">Bayar</a>
                                    @else
                                        <a href="{{route('admin.pnbp.create', ['id' => $trade_permit->id])}}"
                                           class="btn btn-sm btn-primary" title="Buat PNBP">PNBP</a><br><br>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12">
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
    <script>
        $(document).ready(function () {
            $('#form-search').submit(function (ev) {
                ev.preventDefault();

                var trade_permit_code   = $('#trade_permit_code').val();
                var pnbp_code           = $('#pnbp_code').val();
                var company_name        = $('#company_name').val();
                var date_from           = $('#date_from').val();
                var date_until          = $('#date_until').val();

                location.href = '?trade_permit_code=' + trade_permit_code + '&pnbp_code=' + pnbp_code + '&company_name=' + company_name+ '&date_from=' + date_from+ '&date_until=' + date_until;
            });

            $('#form-reset').click(function (ev) {
                ev.preventDefault();

                location.href = '?trade_permit_code=&pnbp_code=&company_name=&date_from=&date_until=';
            });
        });
    </script>
@endpush
