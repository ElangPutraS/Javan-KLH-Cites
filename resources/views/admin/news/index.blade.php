@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Informasi</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Kelola Informasi</h2>
                    <small class="card-subtitle"></small>
                </div>

                <div class="card-block">

                    @include('includes.notifications')

                    <a href="{{ route('admin.news.create') }}" class="btn btn-primary">Tambah Baru</a>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-default">
                            <tr>
                                <th width="50px">No</th>
                                <th width="150px">Judul</th>
                                <th width="150px">Tanggal Buat</th>
                                <th width="150px">Tanggal Update</th>
                                <th width="100px">Dibuat Oleh </th>
                                <th width="150px">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($news as $item)
                            <tr>
                                <td>{{ (($news->currentPage() - 1 ) * $news->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->created_at->toFormattedDateString() }}</td>
                                <td>{{ $item->updated_at->toFormattedDateString() }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>
                                    <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-primary"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    <a href="javascript:void(0);" onclick="deleteNews(this)" class="btn btn-sm btn-danger">
                                        <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                        <form action="{{ route('admin.news.destroy', $item) }}" method="post">
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
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        function deleteNews(a) {
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus data informasi ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                $(a).find('form').submit();
            });
        }
    </script>
@endpush