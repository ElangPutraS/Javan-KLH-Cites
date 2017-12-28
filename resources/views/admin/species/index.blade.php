@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Kelola Spesies & HS</h1>
        </header>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Daftar Spesies & HS</h2>
                <small class="card-subtitle"></small>
            </div>

            <div class="card-block">
                <form method="post" enctype="multipart/form-data" class="form-inline" id="form-search">
                    <div class="input-group col-sm-3">
                        <span class="input-group-addon" id="basic-month">Kode HS</span>
                        <input class="form-control" type="text" placeholder="Cari kode HS.." name="hs_code" id="hs_code" value="@if(Request::input('hs_code')){{Request::input('hs_code')}} @endif">
                    </div>

                    <div class="input-group col-sm-3">
                        <span class="input-group-addon" id="basic-year">Kode SP</span>
                        <input class="form-control" placeholder="Cari kode sp.." type="text" name="sp_code" id="sp_code" value="@if(Request::input('sp_code')){{Request::input('sp_code')}} @endif">
                    </div>

                    <div class="input-group col-sm-4">
                        <span class="input-group-addon" id="basic-month">Komoditas</span>
                        <input class="form-control" type="text" placeholder="Cari komoditas.." name="category" id="category" value="@if(Request::input('category')){{Request::input('category')}} @endif">
                    </div>

                    <br><br><br>

                    <div class="input-group col-sm-3">
                        <span class="input-group-addon" id="basic-month">Nama Ilmiah</span>
                        <input class="form-control" type="text" placeholder="Cari nama ilmiah.." name="scientific_name" id="scientific_name" value="@if(Request::input('scientific_name')){{Request::input('scientific_name')}} @endif">
                    </div>

                    <div class="input-group col-sm-3">
                        <span class="input-group-addon" id="basic-year">Nama Indonesia</span>
                        <input class="form-control" placeholder="Cari nama indonesia.." type="text" name="indonesia_name" id="indonesia_name" value="@if(Request::input('indonesia_name')){{Request::input('indonesia_name')}} @endif">
                    </div>

                    <div class="input-group col-sm-4">
                        <span class="input-group-addon" id="basic-month">Nama Umum</span>
                        <input class="form-control" type="text" placeholder="Cari nama umum.." name="general_name" id="general_name" value="@if(Request::input('general_name')){{Request::input('general_name')}} @endif">
                    </div>

                    <div class="btn-group col-sm-1" role="group" aria-label="...">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari
                        </button>
                    </div>
                </form>
                @include('includes.notifications')
                <br><a href="{{ route('admin.species.createSpecies') }}" class="btn btn-primary">Tambah Baru</a>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-default">
                        <tr>
                            <th>No</th>
                            <th>HS Code</th>
                            <th>SP Code</th>
                            <th>Nama Ilmiah</th>
                            <th>Nama Indonesia</th>
                            <th>Nama Umum</th>
                            <th>Appendiks</th>
                            <th>Komoditas</th>
                            <th>Kuota Tahun Ini</th>
                            <th>Kuota</th>
                            <th>Aksi</th>
                            <th>Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($species as $spec)
                            <tr>
                                <td>{{ (($species->currentPage() - 1 ) * $species->perPage() ) + $loop->iteration }}</td>
                                <td>{{$spec->hs_code}}</td>
                                <td>{{$spec->sp_code}}</td>
                                <td><i>{{$spec->species_scientific_name}}</i></td>
                                <td>{{$spec->species_indonesia_name}}</td>
                                <td>{{$spec->species_general_name}}</td>
                                <td>
                                    @if($spec->is_appendix!='')
                                        {{$spec->appendixSource->appendix_source_code}}
                                    @else
                                        Tidak Memiliki Appendix
                                    @endif
                                </td>
                                <td>{{$spec->speciesCategory->species_category_name}}</td>
                                <td>
                                    <?php $cek=0;?>
                                    @foreach($spec->speciesQuota as $kuota)
                                        @if($kuota->year == date('Y'))
                                            <?php $cek = $kuota->quota_amount?>
                                        @endif
                                    @endforeach

                                    @if ($cek !==0)
                                        {{$cek}}
                                    @else
                                        Kuota belum ditentukan
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('admin.species.showquota',['id'=>$spec->id])}}" class="btn btn-sm btn-info"><i class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                    <a href="{{ route('admin.species.createquota', ['species_id' => $spec->id]) }}" class="btn btn-sm btn-success"><i class="zmdi zmdi-plus-square zmdi-hc-fw"></i></a>
                                </td>
                                <td>
                                    <a href="{{route('admin.species.editSpecies', ['id' => $spec->id])}}" class="btn btn-sm btn-primary"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    <a onclick="deleteSpecies(this)" data-id="{{$spec->id}}" class="btn btn-sm btn-danger" style="color:white;"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                </td>
                                <td><a href="{{route('admin.species.detail', ['id'=> $spec->id])}}" class="btn btn-sm btn-info"><i class="zmdi zmdi-book zmdi-hc-fw" title="detail"></i></a></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">Data Kosong</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $species->appends(\Illuminate\Support\Facades\Input::except('page'))->render('vendor.pagination.bootstrap-4') }}
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

                var hs_code = $('#hs_code').val();
                var sp_code = $('#sp_code').val();
                var category = $('#category').val();
                var scientific_name = $('#scientific_name').val();
                var indonesia_name = $('#indonesia_name').val();
                var general_name = $('#general_name').val();

                location.href = '?hs_code=' + hs_code + '&sp_code=' + sp_code + '&category=' + category + '&scientific_name=' + scientific_name + '&indonesia_name=' + indonesia_name + '&general_name=' + general_name;
            });
        });

        function deleteSpecies(a) {
            var id=a.getAttribute('data-id');
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus species ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                location.href="species/"+id+"/delete";
            });
        }
    </script>
@endpush