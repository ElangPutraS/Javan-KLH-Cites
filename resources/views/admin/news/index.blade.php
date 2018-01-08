@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Kelola Informasi</h1>
        </header>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Kelola Informasi</h2>
                <small class="card-subtitle"></small>
            </div>

            <div class="card-block">
                <form method="post" enctype="multipart/form-data" class="form-inline" id="form-search">
                    <div class="input-group col-sm-3">
                        <span class="input-group-addon" id="basic-month">Judul</span>
                        <input class="form-control" type="text" placeholder="Cari judul.." name="title" id="title" value="@if(Request::input('title')){{Request::input('title')}} @endif">
                    </div>

                    <div class="input-group col-sm-3">
                        <span class="input-group-addon" id="basic-year">Tanggal Dibuat (dari)</span>
                        <input class="form-control date-picker flatpickr-input active" placeholder="dari tanggal.." type="text" name="date_from" id="date_from" value="@if(Request::input('date_from')){{Request::input('date_from')}} @endif">
                    </div>

                    <div class="input-group col-sm-3">
                        <span class="input-group-addon" id="basic-year">Tanggal Dibuat (sampai)</span>
                        <input class="form-control date-picker flatpickr-input active" placeholder="sampai tanggal.." type="text" name="date_until" id="date_until" value="@if(Request::input('date_until')){{Request::input('date_until')}} @endif">
                    </div>

                    <div class="btn-group col-sm-3" role="group" aria-label="...">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>&nbsp;&nbsp;&nbsp;
                        <button type="reset" class="btn btn-danger" id="form-reset"> Reset Pencarian</button>
                    </div>
                </form><br>
                @include('includes.notifications')

                <a href="{{ route('admin.news.create') }}" class="btn btn-primary">Tambah Baru</a><hr>

                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-default">
                        <tr>
                            <th width="50px">No</th>
                            <th width="150px">Judul</th>
                            <th width="150px">Tanggal DiBuat</th>
                            <th width="150px">Tanggal Diubah</th>
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
                            <td colspan="6"><center>Data Kosong</center></td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {!! $news->appends(\Illuminate\Support\Facades\Input::except('page'))->render('vendor.pagination.bootstrap-4') !!}

            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#form-search').submit(function (ev) {
                ev.preventDefault();

                var title      = $('#title').val();
                var date_from  = $('#date_from').val();
                var date_until = $('#date_until').val();

                location.href = '?title=' + title + '&date_from=' + date_from + '&date_until=' + date_until;
            });

            $('#form-reset').click(function (ev) {
                ev.preventDefault();

                location.href = '?title=&date_from=&date_until=';
            });
        });

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