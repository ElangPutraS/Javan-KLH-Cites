@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Laporan</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Laporan PNBP</h2>
                    <small class="card-subtitle"></small>
                </div>
                <?php
                $total = 0;
                foreach ($payments as $pnbp) {
                    $total = $total + $pnbp->total_payment;
                }
                ?>
                <div class="card-block">
                    <form method="post" enctype="multipart/form-data" class="form-inline" id="form-search">
                        <div class="input-group col-sm-4">
                            <span class="input-group-addon" id="basic-month">Bulan</span>
                            <select name="month" id="month" class="form-control select2" aria-describedby="basic-month">
                                <option value="">--Pilih--</option>
                                <option value="1" {{ Request::input('m') == '1' ? 'selected' : '' }} > Januari
                                </option>
                                <option value="2" {{ Request::input('m') == '2' ? 'selected' : '' }} >Februari
                                </option>
                                <option value="3" {{ Request::input('m') == '3' ? 'selected' : '' }} >Maret
                                </option>
                                <option value="4" {{ Request::input('m') == '4' ? 'selected' : '' }} >April
                                </option>
                                <option value="5" {{ Request::input('m') == '5' ? 'selected' : '' }} >Mei
                                </option>
                                <option value="6" {{ Request::input('m') == '6' ? 'selected' : '' }} >Juni
                                </option>
                                <option value="7" {{ Request::input('m') == '7' ? 'selected' : '' }} >Juli
                                </option>
                                <option value="8" {{ Request::input('m') == '8' ? 'selected' : '' }} >Agustus
                                </option>
                                <option value="9" {{ Request::input('m') == '9' ? 'selected' : '' }} >
                                    September
                                </option>
                                <option value="10" {{ Request::input('m') == '10' ? 'selected' : '' }} >
                                    Oktober
                                </option>
                                <option value="11" {{ Request::input('m') == '11' ? 'selected' : '' }} >
                                    November
                                </option>
                                <option value="12" {{ Request::input('m') == '12' ? 'selected' : '' }} >
                                    Desember
                                </option>
                            </select>
                        </div>

                        <div class="input-group col-sm-4">
                            <span class="input-group-addon" id="basic-year">Tahun</span>
                            <select name="year" id="year" class="form-control select2" aria-describedby="basic-year">
                                <option value="">--Pilih--</option>
                                @foreach($tahun as $year)
                                    <option value="{{ $year->year }}" {{ Request::input('y') == $year->year ? 'selected' : '' }} > {{ $year->year }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="btn-group col-sm-4" role="group" aria-label="...">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-block">
                    <table>
                        <tr>
                            <th>Bulan</th>
                            <td>:</td>
                            <td>
                                <?php
                                if (Request::input('m') !== null) {
                                    switch (Request::input('m')) {
                                        case 1:
                                            echo 'Januari';
                                            break;
                                        case 2:
                                            echo 'Februari';
                                            break;
                                        case 3:
                                            echo 'Maret';
                                            break;
                                        case 4:
                                            echo 'April';
                                            break;
                                        case 5:
                                            echo 'Mei';
                                            break;
                                        case 6:
                                            echo 'Juni';
                                            break;
                                        case 7:
                                            echo 'Juli';
                                            break;
                                        case 8:
                                            echo 'Agustus';
                                            break;
                                        case 9:
                                            echo 'September';
                                            break;
                                        case 10:
                                            echo 'Oktober';
                                            break;
                                        case 11:
                                            echo 'November';
                                            break;
                                        case 12:
                                            echo 'Desember';
                                            break;
                                        default :
                                            echo 'Semua Bulan';
                                            break;
                                    }
                                } else {
                                    echo 'Semua Bulan';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Tahun</th>
                            <td>:</td>
                            <td>
                                <?php
                                if (Request::input('y') !== null) {
                                    if (Request::input('y') == 'all') {
                                        echo 'Semua Tahun';
                                    } else {
                                        echo Request::input('y');
                                    }
                                } else {
                                    echo 'Semua Tahun';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Pemasukan</th>
                            <td>:</td>
                            <td><?=  'Rp. ' . number_format($total, 2, ',', '.') ?></td>
                        </tr>
                    </table>

                    <hr>

                    @include('includes.notifications')

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-default">
                            <tr>
                                <th width="50px">No.</th>
                                <th>Jenis Laporan</th>
                                <th width="150px">Tanggal Pembayaran</th>
                                <th>Kode Permohonan</th>
                                <th>No PNBP</th>
                                <th>Perusahaan</th>
                                <th width="150px">Masa Berlaku</th>
                                <th>IHH</th>
                                <th>EA-EB</th>
                                <th>Nilai Persentase</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($payments as $pnbp)
                                <tr>
                                    <td>{{ (($payments->currentPage() - 1 ) * $payments->perPage() ) + $loop->iteration }}</td>
                                    <td>{{ $pnbp->logTrade->permit_type == 1 ? 'Permohonan' : 'Pembaharuan' }}</td>
                                    <td>{{ Carbon\Carbon::parse($pnbp->created_at)->format('d-m-Y') }}</td>
                                    <td>{{ $pnbp->logTrade->trade_permit_code }}</td>
                                    <td>{{ $pnbp->pnbp_code }}</td>
                                    <td>{{ $pnbp->pnbp->tradePermit->company->company_name }}</td>
                                    <td> {{ Carbon\Carbon::parse($pnbp->logTrade->valid_start)->format('d-m-Y') . ' sd. ' . Carbon\Carbon::parse($pnbp->logTrade->valid_until)->format('d-m-Y')  }} </td>
                                    <td>
                                        <?php
                                        if ($pnbp->total_payment > 100000) {
                                            echo 'Rp. ' . number_format($pnbp->total_payment - 100000, 0, ',', '.');
                                        } else {
                                            echo 'Rp. 0,00';
                                        }
                                        ?>
                                    </td>
                                    <td> Rp. {{ number_format(100000, 0, ',', '.') }} </td>
                                    <td>Rp. {{ number_format($pnbp->pnbp->pnbp_percentage_amount, 0, ',', '.') }}</td>
                                    <td> Rp. {{ number_format($pnbp->total_payment, 0, ',', '.') }} </td>
                                    <td>
                                        <a class="btn btn-success"
                                           href="{{ route('admin.report.printReportDetailSatsln', ['id' => $pnbp->log_trade_permit_id]) }}"
                                           target="_blank"><i class="fa fa-print"></i> Cetak</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12">
                                        <center>Data Kosong</center>
                                    </td>
                                </tr>
                            @endforelse

                            @if(count($payments) > 0)
                                <tr>
                                    <td colspan="12">
                                        <a class="btn btn-success"
                                           href="{{ route('admin.report.printReportPnbp', ['m' => request()->input('m'), 'y' => request()->input('y')]) }}"
                                           target="_blank"><i class="fa fa-print"></i> Cetak List</a>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    {!! $payments->links() !!}

                </div>
            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#form-search').submit(function (ev) {
                ev.preventDefault();

                var month = $('#month').val();
                var year = $('#year').val();

                if (month == '') {
                    month = 'all';
                }

                if (year == '') {
                    year = 'all';
                }

                location.href = '?m=' + month + '&y=' + year;
            });
        });
    </script>

@endpush
