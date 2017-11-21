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

                    <a href="{{ route('admin.news.create') }}" class="btn btn-primary">Tambah Baru</a>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-default">
                            <tr>
                                <th width="50px">No</th>
                                <th width="150px">Kategori</th>
                                <th width="150px">Judul</th>
                                <th width="300px">Isi</th>
                                <th width="150px">Tanggal Buat</th>
                                <th width="150px">Tanggal Update</th>
                                <th width="100px">Dibuat Oleh </th>
                                <th width="150px">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($news as $newss)
                            <tr>
                                <td>{{ (($news->currentPage() - 1 ) * $news->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $newss->kategori }}</td>
                                <td>{{ $newss->judul }}</td>
                                <td>{{ $newss->isi }}</td>
                                <td>{{ $newss->created_at->toFormattedDateString() }}</td>
                                <td>{{ $newss->updated_at->toFormattedDateString() }}</td>
                                <td>{{ $newss->user->name }}</td>
                                <td>
                                    <a href="{{ route('admin.news.edit', $newss) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="javascript:void(0);" onclick="confirm('Anda ingin menghapus data ini?') ? $(this).find('form').submit() : false" class="btn btn-sm btn-danger">
                                        Hapus
                                        <form action="{{ route('admin.news.destroy', $newss) }}" method="post">
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

                    {!! $news->links() !!}

                </div>
            </div>
        </div>
    </section>
@endsection
