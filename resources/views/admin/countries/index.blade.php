@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Negara</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Negara</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">
                    <form method="post" enctype="multipart/form-data" class="form-inline" id="form-search">
                        <div class="input-group col-sm-4">
                            <span class="input-group-addon" id="basic-month">Kode Negara</span>
                            <input class="form-control" type="text" placeholder="Cari kode negara.." name="country_code" id="country_code" value="@if(Request::input('c')){{Request::input('c')}} @endif">
                        </div>

                        <div class="input-group col-sm-4">
                            <span class="input-group-addon" id="basic-year">Nama Negara</span>
                            <input class="form-control" placeholder="Cari nama negara.." type="text" name="country_name" id="country_name" value="@if(Request::input('n')){{Request::input('n')}} @endif">
                        </div>

                        <div class="btn-group col-sm-4" role="group" aria-label="...">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari
                            </button>
                        </div>
                    </form>
                    @include('includes.notifications')

                    <br><a href="{{ route('admin.countries.create') }}" class="btn btn-primary">Tambah Baru</a>

                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-default">
                            <tr>
                                <th width="50px">No</th>
                                <th>Kode Negara</th>
                                <th>Nama Negara</th>
                                <th width="150px">Tanggal Dibuat</th>
                                <th width="150px">Tanggal Diperbarui</th>
                                <th width="150px">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($countries as $country)
                            <tr>
                                <td>{{ (($countries->currentPage() - 1 ) * $countries->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $country->country_code }}</td>
                                <td>{{ $country->country_name }}</td>
                                <td>{{ $country->created_at->toFormattedDateString() }}</td>
                                <td>{{ $country->updated_at->toFormattedDateString() }}</td>
                                <td>
                                   <a href="{{ route('admin.countries.edit', $country) }}" class="btn btn-sm btn-primary"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    <a href="javascript:void(0);" onclick="deleteCountries(this)" class="btn btn-sm btn-danger">
                                        <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                        <form action="{{ route('admin.countries.destroy', $country) }}" method="post">
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

                    {!! $countries->appends(\Illuminate\Support\Facades\Input::except('page'))->render('vendor.pagination.bootstrap-4') !!}

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

                var code = $('#country_code').val();
                var name = $('#country_name').val();

                location.href = '?c=' + code + '&n=' + name;
            });
        });

        function deleteCountries(a) {
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus data Negara ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                $(a).find('form').submit();
            });
        }
    </script>
@endpush
