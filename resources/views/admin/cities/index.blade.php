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

                    @include('includes.notifications')

                    <a href="{{ route('admin.cities.create') }}" class="btn btn-primary">Tambah Baru</a>

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

                    {!! $cities->links('vendor.pagination.bootstrap-4') !!}

                </div>
            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
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
