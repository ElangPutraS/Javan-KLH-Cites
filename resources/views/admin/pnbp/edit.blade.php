@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Penerimaan Negara Bukan Pajak (PNBP)</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Ubah PNBP Permohonan SATLS-LN</h2>
                    <small class="card-subtitle">Status Permohonan :
                        @if($trade_permit->tradeStatus->status_code==100)
                            <span class="badge badge-warning">{{ $trade_permit->tradeStatus->status_name }}</span>
                        @elseif($trade_permit->tradeStatus->status_code==200)
                            <span class="badge badge-success">{{ $trade_permit->tradeStatus->status_name }}</span>
                        @elseif($trade_permit->tradeStatus->status_code==300)
                            <span class="badge badge-danger">{{ $trade_permit->tradeStatus->status_name }}</span>
                        @else
                            <span class="badge badge-info">{{ $trade_permit->tradeStatus->status_name }}</span>
                        @endif
                    </small>
                </div>

                <div class="card-block">
                    @include('includes.notifications')

                    <form action="{{route('admin.pnbp.update', ['id'=> $trade_permit->id])}}" method="post" enctype="multipart/form-data" class="form-horizontal" id="form-submission">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <h5>Tentukan Nominal PNBP</h5>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nominal PNBP</label>
                            <div class="col-sm-14">
                                @if(count($trade_permit->pnbp)>0)
                                    <input type="number" min="1" name="pnbp_amount" value="{{ old('name', array_get($trade_permit->pnbp, 'pnbp_amount')) }}" class="form-control" required>
                                @else
                                    <input type="number" min="1" name="pnbp_amount" value="0" class="form-control" required>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-success waves-effect">Simpan</button>
                                <a href="{{ route('admin.pnbp.index') }}" class="btn btn-default">Kembali ke Daftar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-block">

                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" id="form-submission">
                        {!! csrf_field() !!}
                        
                        <div class="form-group">
                            <h5>A. Informasi Pelaku Usaha</h5>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nama Pelaku Usaha</label>
                            <div class="col-sm-14">
                                <input type="text" name="name" class="form-control" value="{{ old('name', array_get($user, 'name')) }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Nama Usaha</label>
                            <div class="col-sm-14">
                                <input type="text" name="company_name" class="form-control" value="{{ old('identity_number', array_get($user->userProfile->company, 'company_name')) }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>B. Informasi Permohonan</h5>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Kode Permohonan</label>
                            <div class="col-sm-14">
                                <input type="text" name="trade_permit_code" class="form-control" value="{{ old('trade_permit_code', array_get($trade_permit, 'trade_permit_code')) }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Jenis Perdagangan</label>
                            <div class="col-sm-14">
                                <input type="text" name="trading_type_id" class="form-control" value="{{ old('trading_type_id', array_get($trade_permit->tradingType, 'trading_type_name')) }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Jenis Kegiatan</label>
                            <div class="col-sm-14">
                                <input type="text" name="purpose_type_id" class="form-control" value="{{ old('purpose_type_id', array_get($trade_permit->purposeType, 'purpose_type_name')) }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Masa Berlaku</label>
                            <div class="col-sm-14">
                                <input type="text" name="trading_type_id" class="form-control" value="{{ old('trading_type_id', array_get($trade_permit, 'period')) }} Bulan" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Pelabuhan Ekspor</label>
                            <div class="col-sm-14">
                                <input type="text" name="port_exportation" class="form-control" value="{{ old('port_exportation', array_get($trade_permit->portExpor, 'port_name')) }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Pelabuhan Tujuan</label>
                            <div class="col-sm-14">
                                <input type="text" name="port_destination" class="form-control" value="{{ old('port_destination', array_get($trade_permit->portExpor, 'port_name')) }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Penerima</label>
                            <div class="col-sm-14">
                                <input type="text" name="consignee" class="form-control" value="{{ old('consignee', array_get($trade_permit, 'consignee')) }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Jenis Appendix</label>
                            <div class="col-sm-14">
                                <input type="text" name="appendix_type" class="form-control" value="<?php if($trade_permit->appendix_type=='EA'){echo 'SATS-LN Site (EA)';}else{ echo 'SATS-LN Non Site (EB)';}?>" readonly>
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
                                        <a href="{{$document->pivot->download_url}}">[ <i class="zmdi zmdi-download zmdi-hc-fw"></i> download ]</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="form-group">
                            <h5>D. Daftar Spesimen</h5>
                            <p>Spesimen yang telah dipilih, wajib diisi!</p>
                        </div>
                        @foreach($trade_permit->tradeSpecies as $species)
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <b>{{$species->species_indonesia_name}} (<i>{{$species->species_scientific_name}}</i>)</b>
                                    </div> 
                                    <div class="col-sm-4">
                                        Jenis Kelamin ({{$species->speciesSex->sex_name}})
                                    </div>
                                    <div class="col-sm-4">
                                        Jumlah {{$species->pivot->total_exported}}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        function acceptTradePermit(a) {
            var id=a.getAttribute('data-id');
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan memverifikasi permohonan SATSL-LN?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                location.href='{{url('admin/verificationSub/acc')}}/'+id;
            });
        }

        function rejectTradePermit(a) {
            var id=a.getAttribute('data-id');
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menolak verifikasi permohonan SATSL-LN?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                location.href='{{url('admin/verificationSub/rej')}}/'+id;
            });
        }
    </script>
@endpush