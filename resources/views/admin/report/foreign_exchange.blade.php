@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Laporan</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Laporan Devisa Negara</h2>
                    <small class="card-subtitle"></small>
                </div>
                <?php
                $total = 0;
                foreach ($species as $spec) {
                    $total = $total + ($spec->total_export*$spec->nominal);
                }
                ?>
                <div class="card-block">
                    <form method="post" enctype="multipart/form-data" class="form-inline" id="form-search">
                        <div class="input-group col-sm-5">
                            <span class="input-group-addon" id="basic-month">Nama Ilmiah Spesies</span>
                            <input class="form-control" type="text" placeholder="Cari nama ilmiah spesies.." name="scientific_name" id="scientific_name" value="@if(Request::input('scientific_name')){{Request::input('scientific_name')}} @endif">
                        </div>

                        <div class="input-group col-sm-5">
                            <span class="input-group-addon" id="basic-year">Nama Indonesia Spesies</span>
                            <input class="form-control" placeholder="Cari nama indonesia spesies.." type="text" name="indonesia_name" id="indonesia_name" value="@if(Request::input('indonesia_name')){{Request::input('indonesia_name')}} @endif">
                        </div><br><br><br>

                        <div class="input-group col-sm-5">
                            <span class="input-group-addon" id="basic-year">Nama Umum Spesies</span>
                            <input class="form-control" placeholder="Cari nama umum spesies.." type="text" name="general_name" id="general_name" value="@if(Request::input('general_name')){{Request::input('general_name')}} @endif">
                        </div>

                        <div class="input-group col-sm-5">
                            <span class="input-group-addon" id="basic-year">Tahun</span>
                            <select name="year" id="year" class="form-control select2" aria-describedby="basic-year">
                                <option value="">--Pilih--</option>
                                @foreach($years as $year)
                                    <option value="{{ $year->year }}" {{ Request::input('year') == $year->year ? 'selected' : '' }} > {{ $year->year }}</option>
                                @endforeach
                            </select>
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
                            <th>Tahun&nbsp;&nbsp;&nbsp;</th>
                            <td>: &nbsp;&nbsp;&nbsp;</td>
                            <td>
                                @if(Request::input('year'))
                                    {{ Request::input('year') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Total Devisa Negara &nbsp;&nbsp;&nbsp;</th>
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
                                <th>Tahun</th>
                                <th>Nama Ilmiah Spesies</th>
                                <th>Nama Indonesia Spesies</th>
                                <th>Nama Umum Spesies</th>
                                <th>Total Ekspor</th>
                                <th>Harga Patokan</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($species as $spec)
                                <tr>
                                    <td>{{ (($species->currentPage() - 1 ) * $species->perPage() ) + $loop->iteration }}</td>
                                    <td>{{ $spec->year }}</td>
                                    <td><i>{{ $spec->species_scientific_name }}</i></td>
                                    <td>{{ $spec->species_indonesia_name }}</td>
                                    <td>{{ $spec->species_general_name }}</td>
                                    <td>{{ $spec->total_export }}</td>
                                    <td>Rp {{ number_format($spec->nominal,2,',','.') }}</td>
                                    <td>Rp {{ number_format($spec->total_export*$spec->nominal,2,',','.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <center>Data Kosong</center>
                                    </td>
                                </tr>
                            @endforelse
                            @if($species !== null)
                                <tr>
                                    <td colspan="8">
                                        <a class="btn btn-success"
                                           href="{{ url('admin/printReportForeignExchange?scientific_name='.request()->input('scientific_name').'&indonesia_name='.request()->input('indonesia_name').'&general_name='.request()->input('general_name').'&year='.request()->input('year')) }}"
                                           target="_blank"><i class="fa fa-print"></i> Cetak List</a>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    {!! $species->appends(\Illuminate\Support\Facades\Input::except('page'))->render('vendor.pagination.bootstrap-4') !!}

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

                var scientific_name = $('#scientific_name').val();
                var indonesia_name = $('#indonesia_name').val();
                var general_name = $('#general_name').val();
                var year = $('#year').val();

                location.href = '?scientific_name=' + scientific_name + '&indonesia_name=' + indonesia_name + '&general_name=' + general_name + '&year=' + year;
            });
        });
    </script>

@endpush
