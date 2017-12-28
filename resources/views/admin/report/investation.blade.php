@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Laporan</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Laporan Investasi Perusahaan</h2>
                    <small class="card-subtitle"></small>
                </div>
                <?php
                $total = 0;
                foreach ($users as $user) {
                    $total = $total + $user->company->investation_total;
                }
                ?>
                <div class="card-block">
                    <form method="post" enctype="multipart/form-data" class="form-inline" id="form-search">
                        <div class="input-group col-sm-5">
                            <span class="input-group-addon" id="basic-month">Nama Perusahaan</span>
                            <input class="form-control" type="text" placeholder="Cari nama perusahaan.." name="company_name" id="company_name" value="@if(Request::input('c')){{Request::input('c')}} @endif">
                        </div>

                        <div class="input-group col-sm-5">
                            <span class="input-group-addon" id="basic-year">Nama Pemilik Usaha</span>
                            <input class="form-control" placeholder="Cari nama pemilik usaha.." type="text" name="owner_name" id="owner_name" value="@if(Request::input('o')){{Request::input('o')}} @endif">
                        </div><br><br><br>

                        <div class="input-group col-sm-5">
                            <span class="input-group-addon" id="basic-year">Tanggal Pendaftaran (dari)</span>
                            <input class="form-control date-picker flatpickr-input active" placeholder="dari tanggal.." type="text" name="date_from" id="date_from" value="@if(Request::input('df')){{Request::input('df')}} @endif">
                        </div>

                        <div class="input-group col-sm-5">
                            <span class="input-group-addon" id="basic-year">Tanggal Pendaftaran (sampai)</span>
                            <input class="form-control date-picker flatpickr-input active" placeholder="dari tanggal.." type="text" name="date_until" id="date_until" value="@if(Request::input('du')){{Request::input('du')}} @endif">
                        </div>

                        <div class="btn-group col-sm-1" role="group" aria-label="...">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-block">
                    <table>
                        <tr>
                            <th>Tanggal Pendaftaran dari&nbsp;&nbsp;&nbsp;</th>
                            <td>: &nbsp;&nbsp;&nbsp;</td>
                            <td>
                                @if(Request::input('df'))
                                    {{ Carbon\Carbon::createFromFormat('Y-m-d', request()->input('df'))->toFormattedDateString() }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Pendaftaran sampai &nbsp;&nbsp;&nbsp;</th>
                            <td>: &nbsp;&nbsp;&nbsp;</td>
                            <td>
                                @if(Request::input('du'))
                                    {{ Carbon\Carbon::createFromFormat('Y-m-d', request()->input('du'))->toFormattedDateString() }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Total Investasi &nbsp;&nbsp;&nbsp;</th>
                            <td>: &nbsp;&nbsp;&nbsp;</td>
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
                                <th>Tanggal Pendaftaran</th>
                                <th>Nama Perusahaan</th>
                                <th>Nama Pemilik Usaha</th>
                                <th>Jumlah Investasi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ (($users->currentPage() - 1 ) * $users->perPage() ) + $loop->iteration }}</td>
                                    <td>{{ $user->company->created_at->toFormattedDateString() }}</td>
                                    <td>{{ $user->company->company_name }}</td>
                                    <td>{{ $user->company->owner_name }}</td>
                                    <td>Rp {{ number_format($user->company->investation_total,2,',','.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11">
                                        <center>Data Kosong</center>
                                    </td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="11">
                                    <a class="btn btn-success"
                                       href="{{ url('admin/printReportInvestation?c='.request()->input('c').'&o='.request()->input('o').'&df='.request()->input('df').'&du='.request()->input('du')) }}"
                                       target="_blank"><i class="fa fa-print"></i> Cetak List</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    {!! $users->appends(\Illuminate\Support\Facades\Input::except('page'))->render('vendor.pagination.bootstrap-4') !!}

                </div>
            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).ready(function () {
                $('#form-search').submit(function (ev) {
                    ev.preventDefault();

                    var company_name = $('#company_name').val();
                    var owner_name = $('#owner_name').val();
                    var date_from = $('#date_from').val();
                    var date_until = $('#date_until').val();

                    location.href = '?c=' + company_name + '&o=' + owner_name + '&df=' + date_from + '&du=' + date_until;
                });
            });
        });
    </script>

@endpush
