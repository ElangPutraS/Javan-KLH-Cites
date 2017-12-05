@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Jenis Kelamin Species</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Jenis Kelamin Species</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">

                    @include('includes.notifications')

                    <a href="{{ route('admin.speciesSex.create') }}" class="btn btn-primary">Tambah Baru</a>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-default">
                            <tr>
                                <th width="50px">No</th>
                                <th>Kode Jenis Kelamin Species</th>
                                <th>Nama Jenis Kelamin Species</th>
                                <th width="150px">Tanggal Dibuat</th>
                                <th width="150px">Tanggal Diperbarui</th>
                                <th width="150px">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($speciessex as $item)
                            <tr>
                                <td>{{ (($speciessex->currentPage() - 1 ) * $speciessex->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $item->sex_code }}</td>
                                <td>{{ $item->sex_name }}</td>
                                <td>{{ $item->created_at->toFormattedDateString() }}</td>
                                <td>{{ $item->updated_at->toFormattedDateString() }}</td>
                                <td>
                                   <a href="{{ route('admin.speciesSex.edit', $item) }}" class="btn btn-sm btn-primary"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    <a href="javascript:void(0);" onclick="deleteSpeciesSex(this)" class="btn btn-sm btn-danger">
                                        <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                        <form action="{{ route('admin.speciesSex.destroy', $item) }}" method="post">
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

                    {!! $speciessex->links() !!}

                </div>
            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        function deleteSpeciesSex(a) {
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus data Jenis Kelamin Species ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                $(a).find('form').submit();
            });
        }
    </script>
@endpush
