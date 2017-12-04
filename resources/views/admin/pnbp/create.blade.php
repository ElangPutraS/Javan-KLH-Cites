@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Penerimaan Negara Bukan Pajak (PNBP)</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Buat PNBP Permohonan SATS-LN</h2>
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

                    <form action="{{ route('admin.pnbp.store', ['id' => $trade_permit->id]) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        {!! csrf_field() !!}
                        
                        <div class="form-group">
                            <label class="control-label">Kode Permohonan</label>
                            <div class="col-sm-14">
                                <input type="text" name="trade_permit_code" class="form-control" value="{{ old('trade_permit_code', array_get($trade_permit, 'trade_permit_code')) }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Kode PNBP</label>
                            <div class="col-sm-14">
                                <input type="text" name="pnbp_code" class="form-control" value="{{ $pnbp_code }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Jenis Permohonan</label>
                            <div class="col-sm-14">
                                <input type="text" name="permit_type" class="form-control" value="@if($trade_permit->permit_type == 1) @if($trade_permit->period<6) Permohonan Bertingkat @else Permohonan Langsung @endif @else Pembaharuan Permohonan @endif" readonly>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                    <center><h5>Tagihan</h5></center>
                                        <thead class="thead-default">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Tagihan</th>
                                            <th>Jumlah</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $no=1;
                                            $total=0;
                                        ?>
                                        @foreach($trade_permit->tradeSpecies as $species)
                                            @if($trade_permit->permit_type == 1)
                                                <?php $total=$total+($species->pivot->total_exported * $species->nominal)?>
                                            @endif
                                        @endforeach
                                            <tr>
                                                <td><?=$no++?></td>
                                                <td>IHH</td>
                                                <td>Rp. {{ number_format($total,2,',','.') }}</td>
                                            </tr>
                                            <?php $total=$total+100000?>
                                            <tr>
                                                <td><?=$no++?></td>
                                                <td>Blanko</td>
                                                <td>Rp. {{ number_format(100000,2,',','.') }}</td>
                                            </tr>

                                            <tr>
                                                <td colspan="2" align="right"><b>Total Tagihan</b></td>
                                                <td><b>Rp. {{ number_format($total,2,',','.') }}</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="pnbp_amount" class="form-control" value="{{ $total }}">
                                </div>
                            </div>
                        </div>

                    <div class="profile__info">
                        <center>
                            @if($trade_permit->pnbp === null)
                                <button type="submit" class="btn btn-success waves-effect">Simpan</button>&nbsp;&nbsp;&nbsp;&nbsp;
                            @else
                                <font color="red"> PNBP Permohonan ini telah dibuat! </font> <br><br>
                            @endif
                            <a href="{{ route('admin.pnbp.index') }}" class="btn btn-default">Kembali ke Daftar</a>
                        </center>
                    </div>
                    
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