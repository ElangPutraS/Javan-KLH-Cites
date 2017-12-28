@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Kelola Kategori Spesies</h1>
        </header>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Daftar Kategori Spesies</h2>
                <small class="card-subtitle"></small>
            </div>

            <div class="card-block">
                <form method="post" enctype="multipart/form-data" class="form-inline" id="form-search">
                    <div class="input-group col-sm-5">
                        <span class="input-group-addon" id="basic-month">Kode Kategori</span>
                        <input class="form-control" type="text" placeholder="Cari kode kategori spesies" name="category_code" id="category_code" value="@if(Request::input('code')){{Request::input('code')}} @endif">
                    </div>

                    <div class="input-group col-sm-5">
                        <span class="input-group-addon" id="basic-year">Nama Kategori</span>
                        <input class="form-control" placeholder="Cari nama kategori spesies" type="text" name="category_name" id="category_name" value="@if(Request::input('name')){{Request::input('name')}} @endif">
                    </div>

                    <div class="btn-group col-sm-2" role="group" aria-label="...">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari
                        </button>
                    </div>
                </form>
                @include('includes.notifications')

                <br><a href="{{ route('admin.species.createCategory') }}" class="btn btn-primary">Tambah Baru</a>
                <hr>
                <div class="table-responsive table-bordered table-sm">
                    <table class="table">
                        <thead class="thead-default">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $cat)
                                <tr>
                                    <td>{{ (($categories->currentPage() - 1 ) * $categories->perPage() ) + $loop->iteration }}</td>
                                    <td>{{$cat->species_category_code}}</td>
                                    <td>{{$cat->species_category_name}}</td>
                                    <td>
                                        <a href="{{route('admin.species.editCategory', ['id' => $cat->id])}}"class="btn btn-sm btn-primary"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                        <a onclick="deleteKategori(this)" data-id="{{$cat->id}}" class="btn btn-sm btn-danger" style="color:white;"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="8"><center>Data Kosong</center></td>
                            </tr>
                                @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $categories->appends(\Illuminate\Support\Facades\Input::except('page'))->render('vendor.pagination.bootstrap-4') }}
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

                var code = $('#category_code').val();
                var name = $('#category_name').val();

                location.href = '?code=' + code + '&name=' + name;
            });
        });

        function deleteKategori(a) {
            var id=a.getAttribute('data-id');
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus kategori spesies ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                location.href="category/"+id+"/deleteCategory";
            });
        }
    </script>
@endpush