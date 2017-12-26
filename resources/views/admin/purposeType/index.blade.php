@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Jenis Kegiatan</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Jenis Kegiatan</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">
                    <form method="post" enctype="multipart/form-data" class="form-inline" id="form-search">
                        <div class="input-group col-sm-4">
                            <span class="input-group-addon" id="basic-month">Kode Jenis Kegiatan</span>
                            <input class="form-control" type="text" placeholder="Cari kode jenis kegiatan" name="purpose_type_code" id="purpose_type_code" value="@if(Request::input('c')){{Request::input('c')}} @endif">
                        </div>

                        <div class="input-group col-sm-4">
                            <span class="input-group-addon" id="basic-year">Nama Jenis Kegiatan</span>
                            <input class="form-control" placeholder="Cari nama jenis kegiatan" type="text" name="purpose_type_name" id="purpose_type_name" value="@if(Request::input('n')){{Request::input('n')}} @endif">
                        </div>

                        <div class="btn-group col-sm-2" role="group" aria-label="...">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari
                            </button>
                        </div>
                    </form>

                    @include('includes.notifications')

                    <br><a href="{{ route('admin.purposeType.create') }}" class="btn btn-primary">Tambah Baru</a>

                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-default">
                            <tr>
                                <th width="50px">No</th>
                                <th>Kode Jenis Kegiatan</th>
                                <th>Nama Jenis Kegiatan</th>
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

                    {!! $purposetypes->appends(\Illuminate\Support\Facades\Input::except('page'))->render('vendor.pagination.bootstrap-4') !!}

                </div>
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

                var code = $('#purpose_type_code').val();
                var name = $('#purpose_type_name').val();

                location.href = '?c=' + code + '&n=' + name;
            });
        });

        function deletePurposeType(a) {
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus data Jenis Kegiatan ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                $(a).find('form').submit();
            });
        }
    </script>
@endpush
