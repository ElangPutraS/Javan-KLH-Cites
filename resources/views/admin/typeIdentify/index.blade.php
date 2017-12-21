@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Tipe Identitas</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Tipe Identitas</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">

                    @include('includes.notifications')

                    <a href="{{ route('admin.typeIdentify.create') }}" class="btn btn-primary">Tambah Baru</a>
                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-default">
                            <tr>
                                <th width="50px">No</th>
                                <th>Nama Tipe Identitas</th>
                                <th width="150px">Tanggal Dibuat</th>
                                <th width="150px">Tanggal Diperbarui</th>
                                <th width="150px">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($type_identify as $typeidentify)
                            <tr>
                                <td>{{ (($type_identify->currentPage() - 1 ) * $type_identify->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $typeidentify->type_identify_name }}</td>
                                <td>{{ $typeidentify->created_at->toFormattedDateString() }}</td>
                                <td>{{ $typeidentify->updated_at->toFormattedDateString() }}</td>
                                <td>
                                   <a href="{{ route('admin.typeIdentify.edit', $typeidentify) }}" class="btn btn-sm btn-primary"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    <a href="javascript:void(0);" onclick="deleteTypeIdentify(this)" class="btn btn-sm btn-danger">
                                        <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                        <form action="{{ route('admin.typeIdentify.destroy', $typeidentify) }}" method="post">
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

                    {!! $type_identify->links('vendor.pagination.bootstrap-4') !!}

                </div>
            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        function deleteTypeIdentify(a) {
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus data Tipe Identitas ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                $(a).find('form').submit();
            });
        }
    </script>
@endpush
