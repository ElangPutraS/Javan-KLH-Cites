@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Daftar Kuota</h1>
        </header>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Kuota Species {{$species->species_indonesia_name}}</h2>
                <small class="card-subtitle">({{$species->species_scientific_name}})</small>
            </div>

            <div class="card-block">
                @if(session('alert'))
                    <div class="alert alert-{{session('alert')['alert']}} alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button><a href="#" class="alert-link">{{session('alert')['message']}}</a>.
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-default">
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Jumlah Kuota</th>
                            <th>Tanggal Dibuat</th>
                            <th>Tanggal Diperbaharui</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $a=1; ?>
                        @if(count($species)>0)
                            @foreach($quota as $quot)
                                <tr>
                                    <td>{{$a++}}</td>
                                    <td>{{$quot->year}}</td>
                                    <td>{{$quot->quota_amount}}</td>
                                    <td>{{$quot->created_at->toFormattedDateString()}}</td>
                                    <td>{{$quot->updated_at->toFormattedDateString()}}</td>
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
                {{ $quota->links() }}
            </div>
        </div>

    </section>
@endsection
