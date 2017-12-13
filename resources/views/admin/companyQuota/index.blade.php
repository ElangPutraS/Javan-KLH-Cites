@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Kelola Kuota Perusahaan</h1>
        </header>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Daftar Kuota Perusahaan</h2>
                <small class="card-subtitle"></small>
            </div>

            <div class="card-block">
                @include('includes.notifications')
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-default">
                        <tr>
                            <th>No</th>
                            <th>Nama Perusahaan</th>
                            <th>Jumlah Species</th>
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
                                    <td>
                                        <a href="{{route('admin.species.detail', ['id'=> $spec->id])}}" class="btn btn-sm btn-info"><i class="zmdi zmdi-book zmdi-hc-fw" title="detail"></i></a>
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
