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
                    @include('includes.notifications')

                    <form action="{{ route('admin.pnbp.storePayment', ['id' => $trade_permit->id]) }}" method="post"
                          enctype="multipart/form-data" class="form-horizontal" id="form-payment">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="control-label">Kode Permohonan</label>
                            <div class="col-sm-14">
                                <input type="text" name="trade_permit_code" class="form-control"
                                       value="{{ old('trade_permit_code', array_get($trade_permit, 'trade_permit_code')) }}"
                                       readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Jenis Permohonan</label>
                            <div class="col-sm-14">
                                <!--input type="text" name="permit_type" class="form-control"
                                       value="@if($trade_permit->permit_type == 1) @if($trade_permit->period<6) Permohonan Bertahap @else Permohonan Langsung @endif @else Pembaharuan Permohonan @endif"
                                       readonly-->
                                    <input class="form-control" type="text" name="permit_type" value="@if ($trade_permit->permit_type == 1) Permohonan @elseif ($trade_permit->permit_type == 2) Pembaharuan @endif" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Nilai Persentase Jual per-Spesies</label>
                            <div class="col-sm-14">
                                <select class="form-control disabled" name="percentage_value" disabled>
                                    @forelse($percentages as $percentage)
                                        <option value="{{ $percentage->value }}"{{ $trade_permit->pnbp->percentage_value == $percentage->value ? ' selected' : '' }}>
                                            x{{ $percentage->value }}%
                                        </option>
                                    @empty
                                        <option value="0" selected>x0%</option>
                                    @endforelse
                                </select>
                                <input type="hidden" name="pnbp_percentage_amount" value="0">
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
                                            <th>Persentase</th>
                                            <th>Nilai Persentase</th>
                                            <th>Jumlah</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                        $no = 1;
                                        $total = [];
                                        @endphp
                                        @foreach($trade_permit->tradeSpecies as $species)
                                            @if($trade_permit->permit_type == 1)
                                                <?php $total[] = $species->pivot->total_exported * $species->nominal; ?>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>IHH</td>
                                            <td>{{ count($total) . 'x' . $trade_permit->pnbp->percentage_value }}%</td>
                                            <td>
                                                @if($trade_permit->permit_type == 1)
                                                    Rp. {{ number_format($trade_permit->pnbp->pnpb_percentage_amount, 0, ',', '.')  }}
                                                    @elseif($trade_permit->permit_type == 2)
                                                    Rp. {{ number_format(count($total) * $trade_permit->pnbp->percentage_value, 0, ',', '.')  }}
                                                    @endif
                                            </td>
                                            <td>
                                                Rp. {{ number_format(array_sum($total), 0, ',', '.') }}
                                                @if(empty($total))
                                                    (Lunas)
                                                @endif
                                            </td>
                                            <td>
                                                @if($trade_permit->permit_type == 1)
                                                    Rp. {{ number_format(array_sum($total) + $trade_permit->pnbp->pnbp_percentage_amount, 0, ',', '.') }}
                                                    @elseif($trade_permit->permit_type == 2)
                                                    Rp. {{ number_format(array_sum($total), 0, ',', '.') }}
                                                    @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>Blanko</td>
                                            <td></td>
                                            <td></td>
                                            <td>Rp. {{ number_format($generalValueBlangko->value, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($generalValueBlangko->value, 0, ',', '.') }}</td>
                                        </tr>

                                        <tr>
                                            <td colspan="5" align="right"><b>Total Tagihan</b></td>
                                            <td>
                                                <b>
                                                    @if($trade_permit->permit_type == 1)
                                                        Rp. {{ number_format((array_sum($total) + $trade_permit->pnbp->pnbp_percentage_amount) + $generalValueBlangko->value, 0, ',', '.') }}
                                                        @elseif($trade_permit->permit_type == 2)
                                                        Rp. {{ number_format((array_sum($total)) + $generalValueBlangko->value, 0, ',', '.') }}
                                                        @endif
                                                </b>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    @if($trade_permit->permit_type == 1)
                                        <input type="hidden" name="pnbp_amount" id="pnbp_amount" class="form-control"
                                               value="{{ (array_sum($total) + $trade_permit->pnbp->pnbp_percentage_amount) + $generalValueBlangko->value }}">
                                        @elseif($trade_permit->permit_type == 2)
                                        <input type="hidden" name="pnbp_amount" id="pnbp_amount" class="form-control"
                                               value="{{ (array_sum($total)) + $generalValueBlangko->value }}">
                                        @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Metode Pembayaran</label>
                            <div class="col-sm-14">
                                <select name="payment_method" id="payment_method" class="form-control select2"
                                        onchange="cekPayment(this)" required>
                                    <option value="">-- Pilih Metode Pembayaran --</option>
                                    <option value="cash" {{'cash' == old('payment_method') ? 'selected' : '' }}>Cash
                                    </option>
                                    <option value="transfer" {{'transfer' == old('payment_method') ? 'selected' : '' }}>
                                        Transfer
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div id="formNumber">
                            @if('transfer' == old('payment_method'))
                                <div class="form-group">
                                    <label class="control-label">Nomor Transaksi</label>
                                    <div class="col-sm-14">
                                        <input type="text" name="transaction_number" class="form-control"
                                               value="{{ old("transaction_number") }}" required>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Nominal Pembayaran</label>
                            <div class="col-sm-14">
                                @if($trade_permit->permit_type == 1)
                                    <input type="number" name="nominal" id="nominal" class="form-control"
                                           value="{{ old('nominal') }}" onkeyup="cekKembalian(this)" min="{{ (array_sum($total) + $trade_permit->pnbp->pnbp_percentage_amount) + $generalValueBlangko->value }}" max="{{ (array_sum($total) + $trade_permit->pnbp->pnbp_percentage_amount) + $generalValueTambahUang->value }}" required>
                                    @elseif($trade_permit->permit_type == 2)
                                    <input type="number" name="nominal" id="nominal" class="form-control"
                                           value="{{ old('nominal') }}" onkeyup="cekKembalian(this)" min="{{ (array_sum($total)) + $generalValueBlangko->value }}" max="{{ (array_sum($total)) + $generalValueTambahUang->value }}" required>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Kembalian</label>
                            <div class="col-sm-14">
                                <input type="text" name="cash_back" id="cash_back" class="form-control"
                                       value="{{ old('cash_back') ?? '0' }}" readonly>
                            </div>
                        </div>

                        <div class="profile__info">
                            <center>
                                @if($trade_permit->pnbp === null)
                                    <font color="red"> PNBP belum dibuat! </font> <br><br>
                                @else
                                    @if($trade_permit->pnbp->payment_status == 0)
                                        <button type="submit" class="btn btn-success waves-effect">Simpan</button>&nbsp;
                                        &nbsp;&nbsp;&nbsp;
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
        $(document).ready(function () {

            $('#form-payment').submit(function (ev) {
                var nominal = $('#nominal').val();
                var pnbp_amount = $('#pnbp_amount').val();
                var selisih = parseInt(nominal) - parseInt(pnbp_amount);
                if (selisih < 0) {
                    alert('Nominal kurang dari tagihan, silahkan bayar sesuai tagihan yang dibutuhkan!');
                    ev.preventDefault();
                } else {
                    this.submit();
                }
            });

        });

        function cekPayment(a) {
            var select = $('#payment_method').val();
            var form = '';
            if (select == 'transfer') {
                form += '<div class="form-group"><label class="control-label">Nomor Transaksi</label><div class="col-sm-14"><input type="text" name="transaction_number" class="form-control" value="{{ old("transaction_number") }}" required></div></div>';
            }
            $('#formNumber').html(form);
        }

        function cekKembalian(a) {
            var nominal = $('#nominal').val();
            var pnbp_amount = $('#pnbp_amount').val();
            var selisih = parseInt(nominal) - parseInt(pnbp_amount);
            if (nominal == '') {
                $('#cash_back').val(0);
            } else {
                $('#cash_back').val(selisih);
            }
        }
    </script>
@endpush