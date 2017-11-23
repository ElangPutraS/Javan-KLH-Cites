@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Pelaku Usaha</h1>
            </header>

            <div class="card">
                <div class="card-block">

                    @include('includes.notifications')

                    <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">Tambah Baru</a>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-default">
                            <tr>
                                <th width="50px">No</th>
                                <th>Nama Perusahaan</th>
                                <th>Alamat</th>
                                <th width="150px">Tanggal Dibuat</th>
                                <th width="150px">Tanggal Diperbarui</th>
                                <th width="150px">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($companies as $company)
                            <tr>
                                <td>{{ (($companies->currentPage() - 1 ) * $companies->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $company->company_name }}</td>
                                <td>{{ $company->company_address }}</td>
                                <td>{{ $company->created_at->toFormattedDateString() }}</td>
                                <td>{{ $company->updated_at->toFormattedDateString() }}</td>
                                <td>
                                    <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="javascript:void(0);" onclick="confirm('Anda ingin menghapus data ini?') ? $(this).find('form').submit() : false" class="btn btn-sm btn-danger">
                                        Hapus
                                        <form action="{{ route('admin.companies.destroy', $company) }}" method="post">
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

                    {!! $companies->links() !!}

                </div>
            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        function deleteQuota(a) {
            var id=a.getAttribute('data-id');
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus quota species ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                location.href="delete/"+id;
            });
        }
    </script>
@endpush