@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Permohonan Pembaharuan SATS-LN Pengguna</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Permohonan Pembaharuan SATS-LN</h2>
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

                    <form action="{{ route('admin.verificationRen.acc', ['id' => $trade_permit->id]) }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="form-verification">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <h5>A. Informasi Pelaku Usaha</h5>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label">Nama Pemilik Usaha</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', array_get($user->company, 'owner_name')) }}" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Nama Perusahaan</label>
                                    <input type="text" name="company_name" class="form-control" value="{{ old('identity_number', array_get($user->userProfile->company, 'company_name')) }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label">Nomor NPWP Pemilik Usaha</label>
                                    <input type="text" name="npwp_number_user" class="form-control" value="{{ old('npwp_number_user', array_get($user->userProfile, 'npwp_number')) }}" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Nomor NPWP Perusahaan</label>
                                    <input type="text" name="npwp_number" class="form-control" value="{{ old('npwp_number', array_get($user->company, 'npwp_number')) }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label">Alamat Usaha</label>
                                    <input type="text" name="company_address" class="form-control" value="{{ old('company_address', array_get($user->company, 'company_address')) }}" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Alamat Penangkaran</label>
                                    <input type="text" name="captivity_address" class="form-control" value="{{ old('captivity_address', array_get($user->company, 'captivity_address')) }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label">Masa Berlaku Surat Izin Edar</label>
                                    <input type="text" name="date_distribution" class="form-control" value="{{ Carbon\Carbon::parse($user->company->date_distribution)->toFormattedDateString() }}" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Nomor Kontak</label>
                                    <input type="text" name="mobile" class="form-control" value="{{ old('mobile', array_get($user->userProfile, 'mobile')) }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>B. Informasi Permohonan</h5>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6>Melakukan Perpanjangan ? </h6>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" id="is_renewal1" name="is_renewal" value="1" class="custom-control-input" disabled>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Ya</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" id="is_renewal2" name="is_renewal" value="0" class="custom-control-input" checked disabled>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Tidak</span>
                                    </label>
                                </div>
                                <div class="col-sm-4">
                                    <h6>Cetak Blanko Ulang? </h6>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" id="is_blanko1" name="is_blanko" value="1" class="custom-control-input" checked disabled>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Ya</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" id="is_blanko2" name="is_blanko" value="0" class="custom-control-input" disabled>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Tidak</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="control-label">Jenis Perdagangan</label>
                                    <input type="text" name="trading_type_id" class="form-control" value="{{ old('trading_type_id', array_get($trade_permit->tradingType, 'trading_type_name')) }}" readonly>
                                </div>
                                <div class="col-sm-4">
                                    <label class="control-label">Komoditas</label>
                                    <input type="text" name="category_id" class="form-control" value="{{ $trade_permit->category->species_category_code.' - '.$trade_permit->category->species_category_name }}" readonly>
                                </div>
                                <div class="col-sm-4">
                                    <label class="control-label">Jenis Appendix</label>
                                    <input type="text" name="appendix_type" class="form-control" value="<?php if($trade_permit->appendix_type=='EA'){echo 'SATS-LN Site (EA)';}else{ echo 'SATS-LN Non Site (EB)';}?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="control-label">Maksud Transaksi</label>
                                    <input type="text" name="purpose_type_id" class="form-control" value="{{ old('purpose_type_id', array_get($trade_permit->purposeType, 'purpose_type_name')) }}" readonly>
                                </div>
                                <div class="col-sm-7">
                                    <label class="control-label">Sumber Spesies</label>
                                    <input type="text" name="source_id" class="form-control" value="Spesimen diambil dari alam.{{ old('source_id', array_get($trade_permit->source, 'source_id')) }}" readonly>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="control-label">Penerima</label>
                                    <input type="text" name="consignee" class="form-control" value="{{ old('consignee', array_get($trade_permit, 'consignee')) }}" readonly>
                                </div>
                                <div class="col-sm-7">
                                    <label class="control-label">Alamat Penerima</label>
                                    <input type="text" name="consignee" class="form-control" value="{{ old('consignee', array_get($trade_permit, 'consignee_address')) }}" readonly>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="control-label">Negara Tujuan</label>
                                    <input type="text" name="country_destination" class="form-control" value="Indonesia{{ old('country_destination', array_get($trade_permit->portExpor, 'country_destination')) }}" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Pelabuhan Tujuan</label>
                                    <input type="text" name="port_destination" class="form-control" value="{{ old('port_destination', array_get($trade_permit->portDest, 'port_name')) }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="control-label">Negara Ekspor</label>
                                    <input type="text" name="country_exportation" class="form-control" value="Indonesia{{ old('country_exportation', array_get($trade_permit->portExpor, 'country_exportation')) }}" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Pelabuhan Ekspor</label>
                                    <input type="text" name="port_exportation" class="form-control" value="{{ old('port_exportation', array_get($trade_permit->portExpor, 'port_name')) }}" readonly>
                                </div>
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
                        </div>
                        <div class="card">
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table id="data-table" class="table table-bordered">
                                        <thead class="thead-default">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Species</th>
                                            <th>Satuan</th>
                                            <th>Deskripsi</th>
                                            <th>Kuota Perusahaan</th>
                                            <th>Realisasi Sebelumnya</th>
                                            <th>Jumlah Ekspor Baru</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no=1;?>
                                        @foreach($trade_permit->tradeSpecies as $species)
                                            <?php
                                                $total_exported = $species->pivot->where([['species_id', $species->id], ['trade_permit_id', $trade_permit->id]])->sum('total_exported');
                                                $kuota = $species->companyQuota()->first();
                                            ?>
                                            @if($species->pivot->valid_renewal == $trade_permit->valid_renewal - 1)
                                                <tr>
                                                    <td><?=$no++?></td>
                                                    <td>{{$species->species_indonesia_name}} (<i>{{$species->species_scientific_name}}</i>)</td>
                                                    <td>{{$species->unit->unit_description}}</td>
                                                    <td>{{$species->pivot->description}}</td>
                                                    <td>
                                                        {{ $kuota->pivot->where([['company_id', $trade_permit->company_id], ['species_id', $species->id], ['year', date_format( $trade_permit->updated_at, 'Y')]])->first()->quota_amount }}
                                                        <br>(yang telah terealisasi : {{ $total_exported }})
                                                    </td>
                                                    <td><input type="hidden" name="detail_id[]" value="{{$species->pivot->id}}" max="10"> <input type="text" name="exported_before[]" class="form-control" value="{{$species->pivot->total_exported}}" max="10"></td>
                                                    <td><input type="number" name="exported_now[]" class="form-control" value="0" min="0" max="10"></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-success">
                            <label class="form-control-label">Masa Berlaku yang Diberikan</label>
                            <div class="row">
                                <div class="col-sm-9">
                                    <input type="text" min="1" max="6" name="period" id="period" class="form-control form-control-success" value="{{ old('period', array_get($trade_permit, 'period')) }}" required>
                                </div>
                                <div class="col-sm-2">
                                    Bulan
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                @if($trade_permit->tradeStatus->status_code == '100')
                                    <center>
                                        <button type="button" onclick="acceptTradePermit(this)" data-id="{{$trade_permit->id}}" class="btn btn-success waves-effect">Terima</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="button" onclick="rejectTradePermit(this)" data-id="{{$trade_permit->id}}" class="btn btn-danger waves-effect">Tolak</button>
                                    </center>
                                @endif
                                <br><br>
                                <a href="{{ route('admin.verificationRen.index') }}" class="btn btn-default">Kembali ke Daftar</a>
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

    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>

        function acceptTradePermit(a) {
            var period=$('#period').val();
            if(period > '0' && period <= 6){
                swal({
                    title: 'Apakah Anda Yakin?',
                    text: 'Akan memverifikasi permohonan pembaharuan SATSL-LN?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                }).then(function() {
                    $('#form-verification').submit();
                });
            }else{
                swal(
                    'Oops...',
                    'Masa berlaku pembaharuan permohonan belum Anda isi atau format salah, silahkan isi terlebih dahulu max 6 bulan!',
                    'error'
                )
            }
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
                swal({
                    title: 'Tuliskan alasan penolakan verifikasi',
                    input: 'text',
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    showLoaderOnConfirm: true,
                    allowOutsideClick: false
                }).then(function (alasan) {
                    swal({
                        type: 'success',
                        title: 'Penolakan verifikasi berhasil!`',
                        html: 'Alasan penolakan: ' + alasan
                    });
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:'post',
                        url: window.baseUrl +'/admin/verification/rej/'+id,
                        data: 'alasan='+alasan,
                        success : function(cek){
                            location.href='{{url('admin/verificationRen')}}';

                        }
                    });
                });
            });
        }
    </script>
@endpush