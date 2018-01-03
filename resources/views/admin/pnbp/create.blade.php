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

                    <form action="{{ route('admin.pnbp.store', ['id' => $trade_permit->id]) }}" method="post"
                          enctype="multipart/form-data" class="form-horizontal">
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
                            <label class="control-label">Kode PNBP</label>
                            <div class="col-sm-14">
                                <input type="text" name="pnbp_code" class="form-control" value="{{ $pnbp_code }}"
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
                                <select class="form-control" name="percentage_value">
                                    <option value="0" selected>x0%</option>
                                    @forelse($percentages as $percentage)
                                        <option value="{{ $percentage->value }}">x{{ $percentage->value }}%</option>
                                    @empty

                                    @endforelse
                                </select>
                                <input type="hidden" name="pnbp_percentage_amount" value="0">
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-condensed mb-0">
                                        <center><h5>Tagihan</h5></center>
                                        <thead class="thead-default">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Tagihan</th>
                                            <th>Persentase</th>
                                            <th>Nilai Persentase</th>
                                            <th>Jumlah Ekspor</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $no = 1;
                                        $total = [];
                                        $totalExport = [];
                                        ?>
                                        @foreach($trade_permit->tradeSpecies as $species)
                                            @if($trade_permit->permit_type == 1)
                                                <?php
                                                $total[] = ($species->pivot->total_exported * $species->nominal);
                                                $totalExport[] = $species->pivot->total_exported;
                                                ?>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td><?=$no++?></td>
                                            <td>IHH</td>
                                            <td id="percentage-multiply">{{ count($total) }}x0%</td>
                                            <td id="percentage-multiply-value">Rp. 0</td>
                                            <td>{{ array_sum($totalExport) }}</td>
                                            <td id="amount-total">Rp. {{ number_format(array_sum($total), 0, ',', '.') }}</td>
                                        </tr>
                                        <?php $totall = array_sum($total) + 100000; ?>
                                        <tr>
                                            <td><?=$no++?></td>
                                            <td>Blanko</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Rp. {{ number_format(100000, 0, ',', '.') }}</td>
                                        </tr>

                                        <tr>
                                            <td colspan="5" align="right"><b>Total Tagihan</b></td>
                                            <td id="blanko"><b>Rp. {{ number_format($totall, 0, ',', '.') }}</b></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="pnbp_sub_amount" value="{{ $totall }}">
                                    <input type="hidden" name="pnbp_amount" class="form-control" value="{{ $totall }}">
                                </div>
                            </div>
                        </div>

                        <div class="profile__info">
                            <center>
                                @if($trade_permit->pnbp === null)
                                    <button type="submit" class="btn btn-success waves-effect">Simpan</button>&nbsp;
                                    &nbsp;&nbsp;&nbsp;
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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/numeral.min.js') }}"></script>
    <script>
        function acceptTradePermit(a) {
            var id = a.getAttribute('data-id');
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan memverifikasi permohonan SATSL-LN?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function () {
                location.href = '{{url('admin/verificationSub/acc')}}/' + id;
            });
        }

        function rejectTradePermit(a) {
            var id = a.getAttribute('data-id');
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menolak verifikasi permohonan SATSL-LN?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function () {
                location.href = '{{url('admin/verificationSub/rej')}}/' + id;
            });
        }

        function array_sum(array) {
            var n = 0;

            for (var i = 0; i < array.length; i++) {
                n = n + array[i];
            }

            return n;
        }

        total = '<?= json_encode($total) ?>';
        total_count = parseInt('<?= count($total) ?>');
        totall = parseInt('<?= $totall ?>');

        $('select[name="percentage_value"]').change(function () {
            select_this = $(this);

            $(this).each(function () {
                $('#percentage-multiply').html(total_count + 'x' + $(this).val() + '%');

                species_value = new Array();

                $.each(JSON.parse(total), function (key, value) {
                    species_value.push(value * (parseInt(select_this.val()) / 100));
                });

                $('#percentage-multiply-value').html('Rp. ' + numeral(array_sum(species_value)).format('0,0'));
                $('#amount-total').html('Rp. ' + numeral(array_sum(JSON.parse(total)) + array_sum(species_value)).format('0,0'));
                $('#blanko').html('Rp. ' + numeral(array_sum(JSON.parse(total)) + array_sum(species_value) + 100000).format('0,0'));
                $('input[name="pnbp_percentage_amount"]').val(array_sum(species_value));
                $('input[name="pnbp_sub_amount"]').val(array_sum(JSON.parse(total)));
                $('input[name="pnbp_amount"]').val(array_sum(JSON.parse(total)) + array_sum(species_value) + 100000);
            });
        });
    </script>
@endpush