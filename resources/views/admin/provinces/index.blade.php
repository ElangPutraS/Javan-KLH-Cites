@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Provinsi</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Provinsi</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">

                    @include('includes.notifications')

                    <a href="{{ route('admin.provinces.create') }}" class="btn btn-primary">Tambah Baru</a>

                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-default">
                            <tr>
                                <th width="50px">No</th>
                                <th>Kode Provinsi</th>
                                <th>Nama Provinsi</th>
                                <th width="150px">Tanggal Dibuat</th>
                                <th width="150px">Tanggal Diperbarui</th>
                                <th width="150px">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($provinces as $province)
                            <tr>
                                <td>{{ (($provinces->currentPage() - 1 ) * $provinces->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $province->province_code }}</td>
                                <td>{{ $province->province_name }}</td>
                                <td>{{ $province->created_at->toFormattedDateString() }}</td>
                                <td>{{ $province->updated_at->toFormattedDateString() }}</td>
                                <td>
                                   <a href="{{ route('admin.provinces.edit', $province) }}" class="btn btn-sm btn-primary"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    <a href="javascript:void(0);" onclick="deleteProvinces(this)" class="btn btn-sm btn-danger">
                                        <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                        <form action="{{ route('admin.provinces.destroy', $province) }}" method="post">
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

                    {!! $provinces->links('vendor.pagination.bootstrap-4') !!}

                </div>
            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        function deleteProvinces(a) {
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus data Provinsi ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                $(a).find('form').submit();
            });
        }
    </script>
@endpush
