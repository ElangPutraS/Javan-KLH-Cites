@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Kelola Kuota Ekspor Nasional Spesies & HS</h1>
        </header>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Daftar Kuota Ekspor Nasional Species {{$species->species_indonesia_name}}</h2>
                <small class="card-subtitle">({{$species->species_scientific_name}})</small>
            </div>

            <div class="card-block">
                @include('includes.notifications')
                <a href="{{ route('admin.species.createquota', ['species_id' => Request::segment(3)]) }}" class="btn btn-primary">Tambah Baru</a>
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
                        @if(count($species)>0)
                            @foreach($quota as $quot)
                                <tr>
                                    <td>{{ (($quota->currentPage() - 1 ) * $quota->perPage() ) + $loop->iteration }}</td>
                                    <td>{{$quot->year}}</td>
                                    <td>{{$quot->quota_amount}}</td>
                                    <td>{{$quot->created_at->toFormattedDateString()}}</td>
                                    <td>{{$quot->updated_at->toFormattedDateString()}}</td>
                                    <td>
                                        <a href="{{route('admin.species.plusquota', ['species_id' => Request::segment(3), 'id' => $quot->id])}}" class="btn btn-sm btn-primary"><i class="zmdi zmdi-plus zmdi-hc-fw"></i></a>
                                        <a href="{{route('admin.species.minusquota', ['species_id' => Request::segment(3), 'id' => $quot->id])}}" class="btn btn-sm btn-warning"><i class="zmdi zmdi-minus zmdi-hc-fw"></i></a>
                                        <a style="color:white;" onclick="deleteQuota(this)" data-id="{{$quot->id}}" class="btn btn-sm btn-danger"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
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
                {{ $quota->links() }}<br>
                <a href="{{ route('admin.species.index') }}" class="btn btn-outline-warning waves-effect">Kembali ke Daftar Species</a>
            </div>
        </div>

    </section>
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        function deleteQuota(a) {
            var id=a.getAttribute('data-id');
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus kuota species ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                location.href="delete/"+id;
            });
        }
    </script>
@endpush
