@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Tagihan SATS-LN</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Tagihan SATS-LN</h2>
                    <small class="card-subtitle">No. {{ $trade_permit->trade_permit_code }}</small>
                </div>

                <div class="card-block">

                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <h5>A. Informasi Pelaku Usaha</h5>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nama Pelaku Usaha</label>
                            <div class="col-sm-14">
                                <input type="text" name="name" class="form-control"
                                       value="{{ old('name', array_get($user, 'name')) }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Nama Usaha</label>
                            <div class="col-sm-14">
                                <input type="text" name="company_name" class="form-control"
                                       value="{{ old('identity_number', array_get($user->userProfile->company, 'company_name')) }}"
                                       readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Alamat Usaha</label>
                            <div class="col-sm-14">
                                <input type="text" name="company_address" class="form-control"
                                       value="{{ old('company_address', array_get($user->userProfile->company, 'company_address')) }}"
                                       readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>B. Informasi Permohonan</h5>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Jenis Perdagangan</label>
                            <div class="col-sm-14">
                                <input type="text" name="trading_type_id" class="form-control"
                                       value="{{ old('trading_type_id', array_get($trade_permit->tradingType, 'trading_type_name')) }}"
                                       readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Jenis Kegiatan</label>
                            <div class="col-sm-14">
                                <input type="text" name="purpose_type_id" class="form-control"
                                       value="{{ old('purpose_type_id', array_get($trade_permit->purposeType, 'purpose_type_name')) }}"
                                       readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Masa Berlaku</label>
                            <div class="col-sm-14">
                                <input type="text" name="trading_type_id" class="form-control"
                                       value="{{ old('trading_type_id', array_get($trade_permit, 'period')) }} Bulan"
                                       readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Pelabuhan Ekspor</label>
                            <div class="col-sm-14">
                                <input type="text" name="port_exportation" class="form-control"
                                       value="{{ old('port_exportation', array_get($trade_permit->portExpor, 'port_name')) }}"
                                       readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Pelabuhan Tujuan</label>
                            <div class="col-sm-14">
                                <input type="text" name="port_destination" class="form-control"
                                       value="{{ old('port_destination', array_get($trade_permit->portExpor, 'port_name')) }}"
                                       readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Penerima</label>
                            <div class="col-sm-14">
                                <input type="text" name="consignee" class="form-control"
                                       value="{{ old('consignee', array_get($trade_permit, 'consignee')) }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Jenis Appendix</label>
                            <div class="col-sm-14">
                                <input type="text" name="appendix_type" class="form-control"
                                       value="<?php if ($trade_permit->appendix_type == 'EA') {
                                           echo 'SATS-LN Site (EA)';
                                       } else {
                                           echo 'SATS-LN Non Site (EB)';
                                       }?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>C. Dokumen Unggahan</h5>
                        </div>
                        @foreach($trade_permit->documentTypes as $document)
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <b>{{$document->document_type_name}}</b>
                                    </div>
                                    <div class="col-sm-4">
                                        {{$document->pivot->document_name}}
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="{{$document->pivot->download_url}}">[ <i
                                                    class="zmdi zmdi-download zmdi-hc-fw"></i> download ]</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="form-group">
                            <h5>D. Daftar Tagihan Spesimen</h5>
                            <p></p>
                        </div>
                        <div class="card">
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead class="thead-default">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Species</th>
                                            <th>Deskripsi</th>
                                            <th>Jumlah Ekspor</th>
                                            <th>Persentase</th>
                                            <th>Nilai Persentase</th>
                                            <th>Nilai Ekspor</th>
                                            <th>Jumlah Pembayaran</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $no = 1;
                                        $total = [];
                                        ?>
                                        @foreach($trade_permit->tradeSpecies as $species)
                                            @if($trade_permit->permit_type == 1)
                                                @php
                                                $tradePermit = \App\TradePermit::findOrFail($species->pivot->trade_permit_id);
                                                @endphp
                                                <tr>
                                                    <td><?=$no++?></td>
                                                    <td>{{$species->species_indonesia_name}}
                                                        (<i>{{$species->species_scientific_name}}</i>)
                                                    </td>
                                                    <td>{{$species->species_description}}</td>
                                                    <td>{{$species->pivot->total_exported}}</td>
                                                    <th align="center">x{{ $tradePermit->pnbp->percentage_value ? $tradePermit->pnbp->percentage_value : 0 }}%</th>
                                                    <td align="right">Rp. {{ number_format($species->pivot->total_exported * ($species->nominal * ($tradePermit->pnbp->percentage_value / 100)), 0, ',', '.') }}</td>
                                                    <td align="right">Rp. {{ number_format($species->nominal * $species->pivot->total_exported, 0, ',', '.') }}</td>
                                                    <td align="right">Rp. {{ number_format(($species->nominal * $species->pivot->total_exported) + ($species->pivot->total_exported * ($species->nominal * ($tradePermit->pnbp->percentage_value / 100))), 0, ',', '.') }}</td>
                                                </tr>
                                                <?php $total[] = ($species->nominal * $species->pivot->total_exported) + ($species->pivot->total_exported * ($species->nominal * ($tradePermit->pnbp->percentage_value / 100))); ?>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td><?=$no++?></td>
                                            <td colspan="6">Blanko</td>
                                            <td align="right">Rp. {{ number_format(100000, 0, ',', '.') }}</td>
                                        </tr>
                                        @php $total[] = 100000; @endphp
                                        <tr>
                                            <td colspan="7" align="center"><b>Total Tagihan</b></td>
                                            <td align="right"><b>Rp. {{ number_format(array_sum($total), 0, ',', '.') }}</b></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <a href="{{ route('user.invoice.index') }}" class="btn btn-default">Kembali ke
                                    Daftar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <!-- Data Table -->
    <script src="{{ asset('template/vendors/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/vendors/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template/vendors/bower_components/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('template/vendors/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
@endpush