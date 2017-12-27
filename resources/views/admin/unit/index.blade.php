 @extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Satuan Species</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Satuan Species</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">
                    <form method="post" enctype="multipart/form-data" class="form-inline" id="form-search">
                        <div class="input-group col-sm-5">
                            <span class="input-group-addon" id="basic-month">Kode Satuan</span>
                            <input class="form-control" type="text" placeholder="Cari kode satuan.." name="unit_code" id="unit_code" value="@if(Request::input('c')){{Request::input('c')}} @endif">
                        </div>

                        <div class="input-group col-sm-5">
                            <span class="input-group-addon" id="basic-year">Deskripsi Satuan</span>
                            <input class="form-control" placeholder="Cari deskripsi satuan.." type="text" name="unit_name" id="unit_name" value="@if(Request::input('n')){{Request::input('n')}} @endif">
                        </div>

                        <div class="btn-group col-sm-2" role="group" aria-label="...">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari
                            </button>
                        </div>
                    </form><br>
                    @include('includes.notifications')

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-default">
                            <tr>
                                <th width="50px">No</th>
                                <th>Kode Appendiks</th>
                                <th>Deskripsi</th>
                                <th width="150px">Tanggal Dibuat</th>
                                <th width="150px">Tanggal Diperbarui</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($units as $unit)
                            <tr>
                                <td>{{ (($units->currentPage() - 1 ) * $units->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $unit->unit_code }}</td>
                                <td>{{ $unit->unit_description }}</td>
                                <td>{{ $unit->created_at->toFormattedDateString() }}</td>
                                <td>{{ $unit->updated_at->toFormattedDateString() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">Belum ada data.</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    {!! $units->appends(\Illuminate\Support\Facades\Input::except('page'))->render('vendor.pagination.bootstrap-4') !!}

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

                var code = $('#unit_code').val();
                var name = $('#unit_name').val();

                location.href = '?c=' + code + '&n=' + name;
            });
        });


        function deleteProvinces(a) {
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus data Provinsi ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                $(a).find('form').submit();
            });
        }
    </script>
@endpush
