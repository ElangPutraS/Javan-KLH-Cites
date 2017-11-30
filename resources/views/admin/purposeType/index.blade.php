@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Purpose Type</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Purpose Type</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">

                    @include('includes.notifications')

                    <a href="{{ route('admin.purposeType.create') }}" class="btn btn-primary">Tambah Baru</a>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-default">
                            <tr>
                                <th width="50px">No</th>
                                <th>Kode Purpose Type</th>
                                <th>Nama Purpose Type</th>
                                <th width="150px">Tanggal Dibuat</th>
                                <th width="150px">Tanggal Diperbarui</th>
                                <th width="150px">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($purposetypes as $purposetype)
                            <tr>
                                <td>{{ (($purposetypes->currentPage() - 1 ) * $purposetypes->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $purposetype->purpose_type_code }}</td>
                                <td>{{ $purposetype->purpose_type_name }}</td>
                                <td>{{ $purposetype->created_at->toFormattedDateString() }}</td>
                                <td>{{ $purposetype->updated_at->toFormattedDateString() }}</td>
                                <td>
                                   <a href="{{ route('admin.purposeType.edit', $purposetype) }}" class="btn btn-sm btn-primary"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    <a href="javascript:void(0);" onclick="deletePurposeType(this)" class="btn btn-sm btn-danger">
                                        <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                        <form action="{{ route('admin.purposeType.destroy', $purposetype) }}" method="post">
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

                    {!! $purposetypes->links() !!}

                </div>
            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        function deletePurposeType(a) {
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus data Purpose Type ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                $(a).find('form').submit();
            });
        }
    </script>
@endpush
