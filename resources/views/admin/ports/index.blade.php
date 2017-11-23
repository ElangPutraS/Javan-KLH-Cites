@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Pelabuhan</h1>
            </header>

            <div class="card">
                <div class="card-block">

                    @include('includes.notifications')

                    <a href="{{ route('admin.ports.create') }}" class="btn btn-primary">Tambah Baru</a>

                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-default">
                            <tr>
                                <th width="50px">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th width="150px">Tanggal Dibuat</th>
                                <th width="150px">Tanggal Diperbarui</th>
                                <th width="150px">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($ports as $port)
                            <tr>
                                <td>{{ (($ports->currentPage() - 1 ) * $ports->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $port->port_code }}</td>
                                <td>{{ $port->port_name }}</td>
                                <td>{{ $port->created_at->toFormattedDateString() }}</td>
                                <td>{{ $port->updated_at->toFormattedDateString() }}</td>
                                <td>
                                    <a href="{{ route('admin.ports.edit', $port) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="javascript:void(0);" onclick="confirm('Anda ingin menghapus data ini?') ? $(this).find('form').submit() : false" class="btn btn-sm btn-danger">
                                        Hapus
                                        <form action="{{ route('admin.ports.destroy', $port) }}" method="post">
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

                    {!! $ports->links() !!}

                </div>
            </div>
        </div>
    </section>
@endsection