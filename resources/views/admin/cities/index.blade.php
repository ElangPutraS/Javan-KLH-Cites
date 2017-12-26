@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Kabupaten/Kota</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Kabupaten/Kota</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">
                    <form method="post" enctype="multipart/form-data" class="form-inline" id="form-search">
                        <div class="input-group col-sm-5">
                            <span class="input-group-addon" id="basic-month">Kode Kabupaten/Kota</span>
                            <input class="form-control" type="text" placeholder="Cari kode Kabupaten/Kota.." name="city_code" id="city_code" value="@if(Request::input('c')){{Request::input('c')}} @endif">
                        </div>

                        <div class="input-group col-sm-5">
                            <span class="input-group-addon" id="basic-year">Nama Kabupaten/Kota</span>
                            <input class="form-control" placeholder="Cari nama Kabupaten/Kota.." type="text" name="city_name" id="city_name" value="@if(Request::input('n')){{Request::input('n')}} @endif">
                        </div>

                        <div class="btn-group col-sm-2" role="group" aria-label="...">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari
                            </button>
                        </div>
                    </form>
                    @include('includes.notifications')

                    <br><a href="{{ route('admin.cities.create') }}" class="btn btn-primary">Tambah Baru</a>

                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-default">
                            <tr>
                                <th width="50px">No</th>
                                <th>Kode Kabupaten/Kota</th>
                                <th>Nama Ibukota</th>
                                <th>Nama Kabupaten/Kota</th>
                                <th>Nama Provinsi</th>
                                <th width="150px">Tanggal Dibuat</th>
                                <th width="150px">Tanggal Diperbarui</th>
                                <th width="150px">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($cities as $city)
                            <tr>
                                <td>{{ (($cities->currentPage() - 1 ) * $cities->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $city->city_code }}</td>
                                <td>{{ $city->city_name }}</td>
                                <td>{{ $city->city_name_full }}</td>
                                <td>{{ $city->province->province_name }}</td>
                                <td>{{ $city->created_at->toFormattedDateString() }}</td>
                                <td>{{ $city->updated_at->toFormattedDateString() }}</td>
                                <td>
                                   <a href="{{ route('admin.cities.edit', $city) }}" class="btn btn-sm btn-primary"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    <a href="javascript:void(0);" onclick="deleteCities(this)" class="btn btn-sm btn-danger">
                                        <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                        <form action="{{ route('admin.cities.destroy', $city) }}" method="post">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">Belum ada data.</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    {!! $cities->appends(\Illuminate\Support\Facades\Input::except('page'))->render('vendor.pagination.bootstrap-4') !!}

                </div>
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

                var code = $('#city_code').val();
                var name = $('#city_name').val();

                location.href = '?c=' + code + '&n=' + name;
            });
        });

        function deleteCities(a) {
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus data Kabupaten/Kota ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                $(a).find('form').submit();
            });
        }
    </script>
@endpush
