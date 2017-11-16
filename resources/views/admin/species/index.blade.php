@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Daftar Spesies & HS</h1>
        </header>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Daftar Spesies & HS</h2>
                <small class="card-subtitle"></small>
            </div>

            <div class="card-block">
                @if(session('alert'))
                    <div class="alert alert-{{session('alert')['alert']}} alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button><a href="#" class="alert-link">{{session('alert')['message']}}</a>.
                    </div>
                @endif
                <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">Tambah Baru</a>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-default">
                        <tr>
                            <th>No</th>
                            <th>Nama Ilmiah</th>
                            <th>Nama Indonesia</th>
                            <th>Nama Umum</th>
                            <th>Appendiks</th>
                            <th>Jenis Kelamin</th>
                            <th>Kuota</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $a=1; ?>
                        @if(count($species)>0)
                            @foreach($species as $spec)
                                <tr>
                                    <td>{{$a++}}</td>
                                    <td>{{$spec->species_scientific_name}}</td>
                                    <td>{{$spec->species_indonesia_name}}</td>
                                    <td>{{$spec->species_general_name}}</td>
                                    <td>
                                        @if($spec->is_appendix)
                                            {{$spec->appendixSource->appendix_source_code}}
                                        @else
                                            Tidak Memiliki Appendix
                                        @endif
                                    </td>
                                    <td>{{$spec->speciesSex->sex_name}}</td>
                                    <td>
                                        <a href="{{route('admin.species.showquota',['id'=>$spec->id])}}"><i class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a href=""><i class="zmdi zmdi-plus-square zmdi-hc-fw"></i></a>
                                    </td>
                                    <td>
                                        <a href=""><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                        <a href=""><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
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
                {{ $species->links() }}
            </div>
        </div>

    </section>
@endsection
