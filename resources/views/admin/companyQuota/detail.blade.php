@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Kelola Kuota Ekspor Perusahaan</h1>
        </header>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Daftar Kuota Ekspor Perusahaan</h2>
                <small class="card-subtitle">{{ strtoupper($company->company_name) }}</small>
            </div>

            <div class="card-block">
                <form method="post" enctype="multipart/form-data" class="form-inline" id="form-search">
                    <div class="input-group col-sm-3">
                        <span class="input-group-addon" id="basic-month">Nama Ilmiah</span>
                        <input class="form-control" type="text" placeholder="Cari nama ilmiah.." name="scientific_name" id="scientific_name" value="@if(Request::input('scientific_name')){{Request::input('scientific_name')}} @endif">
                    </div>

                    <div class="input-group col-sm-3">
                        <span class="input-group-addon" id="basic-year">Nama Indonesia</span>
                        <input class="form-control" placeholder="Cari nama indonesia.." type="text" name="indonesia_name" id="indonesia_name" value="@if(Request::input('indonesia_name')){{Request::input('indonesia_name')}} @endif">
                    </div>

                    <div class="input-group col-sm-3">
                        <span class="input-group-addon" id="basic-month">Nama Umum</span>
                        <input class="form-control" type="text" placeholder="Cari nama umum.." name="general_name" id="general_name" value="@if(Request::input('general_name')){{Request::input('general_name')}} @endif">
                    </div>

                    <div class="input-group col-sm-2">
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
                </form><br>
                @include('includes.notifications')
                <a href="{{ route('admin.companyQuota.create', ['id' => $company->id]) }}" class="btn btn-primary">Tambah Baru</a><hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-default">
                        <tr>
                            <th>No</th>
                            <th>Nama Ilmiah Spesies</th>
                            <th>Nama Indonesia Spesies</th>
                            <th>Nama Umum Spesies</th>
                            <th>Tahun</th>
                            <th>Jumlah Kuota</th>
                            <th>Jumlah yang telah terealisasi</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($companyQuota as $quota)
                            <tr>
                                <td>{{ (( $companyQuota->currentPage() - 1 ) * $companyQuota->perPage() ) + $loop->iteration }}</td>
                                <td><i>{{ $quota->species_scientific_name}}</i> </td>
                                <td>{{ $quota->species_indonesia_name }} </td>
                                <td>{{ $quota->species_general_name }} </td>
                                <td>{{  $quota->pivot->year }}</td>
                                <td>{{ $quota->pivot->quota_amount.' '.$quota->unit->unit_description }}</td>
                                <td>{{ $quota->pivot->realization.' '.$quota->unit->unit_description }}</td>
                                <td>
                                    <a href="{{ route('admin.companyQuota.edit', ['company_id' => $company->id, 'id' => $quota->pivot->id]) }}" class="btn btn-sm btn-primary"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    <a href="javascript:void(0);" onclick="deleteQuota(this)" data-company="{{$company->id}}" data-pivot="{{$quota->pivot->id}}" class="btn btn-sm btn-danger">
                                        <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8"><center>Data Kosong</center></td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $companyQuota->links() }}<br>
                <a href="{{ route('admin.companyQuota.index') }}" class="btn btn-default">Kembali ke Daftar</a>
            </div>
        </div>

    </section>
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#form-search').submit(function (ev) {
                ev.preventDefault();

                var year = $('#year').val();
                var scientific_name = $('#scientific_name').val();
                var indonesia_name = $('#indonesia_name').val();
                var general_name = $('#general_name').val();

                location.href = '?scientific_name=' + scientific_name + '&indonesia_name=' + indonesia_name + '&general_name=' + general_name + '&year=' + year ;
            });
        });

        function deleteQuota(a) {
            var company=a.getAttribute('data-company');
            var pivot=a.getAttribute('data-pivot');
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus kuota perusahaan ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                location.href= window.baseUrl +'/admin/companyQuota/'+company+'/delete/'+pivot;
            });
        }
    </script>
@endpush