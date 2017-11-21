@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Daftar Spesies & HS</h1>
        </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"></h2> 
                    <h2>DATA MASTER KATEGORI SPESIES</h2>
                    <a href="{{ route('admin.species.createCategory') }}" class="btn btn-primary float-right">Tambah Baru</a>
                    <small class="card-subtitle"></small>
                </div>

                <div class="card-block">
                
                @include('includes.notifications')
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-default">
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Kategori</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                            @if(count($kategori)>0)
                                @foreach($kategori as $kat)
                                    <tr>
                                        <td>{{$kat->species_kategori_kode}}</td>
                                        <td>{{$kat->species_kategori_name}}</td>
                                        <td>
                                            <a href="{{route('admin.species.editCategory', ['id' => $kat->id])}}"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                            <a style="color:#3eacff;" onclick="deleteKategori(this)" data-id="{{$kat->id}}"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8"><center>Data Kosong</center></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
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
                location.href=id+"/deleteCategory";
            });
        }
    </script>
@endpush