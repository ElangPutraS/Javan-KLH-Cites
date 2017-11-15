@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Informasi</h1>
            </header>

            <div class="card">
                <div class="card-block">

                    @include('includes.notifications')

                    <a href="{{ route('admin.kelolainformasi.create') }}" class="btn btn-primary">Tambah </a>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-default">
                            <tr>
                                <th width="50px">No</th>
                                <th>Kategori</th>
                                <th>Judul</th>
                                <th width="300px">Isi</th>
                                <th width="150px">Tanggal Buat</th>
                                <th width="150px">Tanggal Update</th>
                                <th width="150px">Dibuat Oleh </th>
                                <th width="100px">Aksi</th>
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
                                <td></td>
                                <td></td>
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
