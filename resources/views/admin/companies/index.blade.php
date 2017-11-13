@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Kelola Pelaku Usaha</h1>
        </header>

        <div class="card">
            <div class="card-block">

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
                                <a href="{{ route('admin.companies.destroy', $company) }}" class="btn btn-sm btn-danger">Hapus</a>
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
    </section>
@endsection