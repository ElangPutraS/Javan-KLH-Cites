@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Pelabuhan</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Pelabuhan</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">
                    <form method="post" enctype="multipart/form-data" class="form-inline" id="form-search">
                        <div class="input-group col-sm-4">
                            <span class="input-group-addon" id="basic-month">Kode Pelabuhan</span>
                            <input class="form-control" type="text" placeholder="Cari kode pelabuhan.." name="port_code" id="port_code" value="@if(Request::input('code')){{Request::input('code')}} @endif">
                        </div>

                        <div class="input-group col-sm-4">
                            <span class="input-group-addon" id="basic-year">Nama Pelabuhan</span>
                            <input class="form-control" placeholder="Cari nama pelabuhan.." type="text" name="port_name" id="port_name" value="@if(Request::input('name')){{Request::input('name')}} @endif">
                        </div>

                        <div class="btn-group col-sm-4" role="group" aria-label="...">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari
                            </button>
                        </div>
                    </form>
                    @include('includes.notifications')

                    <br><a href="{{ route('admin.ports.create') }}" class="btn btn-primary">Tambah Baru</a>

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
                                    <a href="{{ route('admin.ports.edit', $port) }}" class="btn btn-sm btn-primary"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    <a href="javascript:void(0);" onclick="deletePort(this)" class="btn btn-sm btn-danger">
                                        <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
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

                   {!! $ports->appends(\Illuminate\Support\Facades\Input::except('page'))->render('vendor.pagination.bootstrap-4') !!}

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

                var code = $('#port_code').val();
                var name = $('#port_name').val();

                location.href = '?code=' + code + '&name=' + name;
            });
        });

        function deletePort(a) {
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus Data Pelabuhan ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                $(a).find('form').submit();
            });
        }
    </script>
@endpush