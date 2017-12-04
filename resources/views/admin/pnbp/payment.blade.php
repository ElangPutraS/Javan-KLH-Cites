@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Penerimaan Negara Bukan Pajak (PNBP)</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Buat PNBP Permohonan SATLS-LN</h2>
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

                    <form action="{{ route('admin.pnbp.storePayment', ['id' => $trade_permit->id]) }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="form-payment">
                        {!! csrf_field() !!}
                        
                        <div class="form-group">
                            <label class="control-label">Kode Permohonan</label>
                            <div class="col-sm-14">
                                <input type="text" name="trade_permit_code" class="form-control" value="{{ old('trade_permit_code', array_get($trade_permit, 'trade_permit_code')) }}" readonly>
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
                                                <td>
                                                    Rp. {{ number_format($total,2,',','.') }} 
                                                    @if($total == 0)
                                                        (Lunas)
                                                    @endif
                                                </td>
                                            </tr>
                                            <?php $total = $total + 100000; ?>
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
                                    <input type="hidden" name="pnbp_amount" id="pnbp_amount" class="form-control" value="{{ $total }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Metode Pembayaran</label>
                            <div class="col-sm-14">
                                <select name="payment_method" id="payment_method" class="form-control select2" onchange="cekPayment(this)" required>
                                    <option value="">-- Pilih Metode Pembayaran --</option>
                                    <option value="cash" {{'cash' == old('payment_method') ? 'selected' : '' }}>Cash</option>
                                    <option value="transfer" {{'transfer' == old('payment_method') ? 'selected' : '' }}>Transfer</option>
                                </select>
                            </div>
                        </div>

                        <div id="formNumber">
                            @if('transfer' == old('payment_method'))
                                <div class="form-group">
                                    <label class="control-label">Nomor Transaksi</label>
                                    <div class="col-sm-14">
                                        <input type="number" name="transaction_number" class="form-control" value="{{ old("transaction_number") }}" required>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Nominal Pembayaran</label>
                            <div class="col-sm-14">
                                <input type="number" name="nominal" id="nominal" class="form-control" value="{{ old('nominal') }}" onkeyup="cekKembalian(this)" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Kembalian</label>
                            <div class="col-sm-14">
                                <input type="text" name="cash_back" id="cash_back" class="form-control" value="{{ old('cash_back') ?? '0' }}" readonly>
                            </div>
                        </div>

                    <div class="profile__info">
                        <center>
                            @if($trade_permit->pnbp === null)
                                <font color="red"> PNBP belum dibuat! </font> <br><br>
                            @else
                                @if($trade_permit->pnbp->payment_status == 0)
                                    <button type="submit" class="btn btn-success waves-effect">Simpan</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                @else
                                    <font color="red"> Tagihan Telah Dibayarkan! </font> <br><br>
                                @endif
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
    <script type="text/javascript">
         $(document).ready(function(){

            $('#form-payment').submit(function(ev) {
                var nominal = $('#nominal').val();
                var pnbp_amount = $('#pnbp_amount').val();
                var selisih =  parseInt(nominal) - parseInt(pnbp_amount);
                if(selisih<0){
                    alert('Nominal kurang dari tagihan, silahkan bayar sesuai tagihan yang dibutuhkan!');
                    ev.preventDefault();
                }else{
                    this.submit();
                }
            });

         });
        function cekPayment (a) {
            var select = $('#payment_method').val();
            var form='';
            if(select == 'transfer'){
                form += '<div class="form-group"><label class="control-label">Nomor Transaksi</label><div class="col-sm-14"><input type="number" name="transaction_number" class="form-control" value="{{ old("transaction_number") }}" required></div></div>';
            }
            $('#formNumber').html(form);
        }

        function cekKembalian (a) {
            var nominal = $('#nominal').val();
            var pnbp_amount = $('#pnbp_amount').val();
            var selisih =  parseInt(nominal) - parseInt(pnbp_amount);
            if(nominal == ''){
                $('#cash_back').val(0);
            }else{
                $('#cash_back').val(selisih);
            }
        }
    </script>
@endpush