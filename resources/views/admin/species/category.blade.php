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
                                            <a href=""><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                            <a href="{{route('admin.species.deleteCategory', ['id' => $kat->id])}}"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
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