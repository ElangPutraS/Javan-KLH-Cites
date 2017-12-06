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

                @include('includes.notifications')

                <a href="{{ route('admin.species.createCategory') }}" class="btn btn-primary">Tambah Baru</a>
                <hr>
                <div class="table-responsive table-bordered table-sm">
                    <table class="table">
                        <thead class="thead-default">
                        <tr>
                            <th>Kode</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>

                        </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $cat)
                                <tr>
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
                {{ $categories->links() }}
            </div>
        </div>
    </section>
@endsection

@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
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