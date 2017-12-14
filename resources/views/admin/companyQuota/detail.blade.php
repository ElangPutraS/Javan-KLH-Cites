@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Kelola Kuota Species Perusahaan</h1>
        </header>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Daftar Kuota Species Perusahaan</h2>
                <small class="card-subtitle">{{ strtoupper($company->company_name) }}</small>
            </div>

            <div class="card-block">
                @include('includes.notifications')
                <a href="{{ route('admin.companyQuota.create', ['id' => $company->id]) }}" class="btn btn-primary">Tambah Baru</a>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-default">
                        <tr>
                            <th>No</th>
                            <th>Nama Species</th>
                            <th>Tahun</th>
                            <th>Jumlah Kuota</th>
                            <th>Jumlah yang telah terealisasi</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($companyQuota as $quota)
                            <tr>
                                <td>{{ (( $companyQuota->currentPage() - 1 ) * $companyQuota->perPage() ) + $loop->iteration }}</td>
                                <td><i>{{ $quota->species_scientific_name}}</i> ( {{$quota->species_indonesia_name}} )</td>
                                <td>{{  $quota->pivot->year }}</td>
                                <td>{{ $quota->pivot->quota_amount.' '.$quota->unit->unit_description }}</td>
                                <td>{{ $quota->pivot->realization.' '.$quota->unit->unit_description }}</td>
                                <td>
                                    <a href="{{ route('admin.companyQuota.edit', ['company_id' => $company->id, 'id' => $quota->pivot->id]) }}" class="btn btn-sm btn-primary"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    <a href="javascript:void(0);" onclick="deleteQuota(this)" data-company="{{$company->id}}" data-pivot="{{$quota->pivot->id}}" class="btn btn-sm btn-danger">
                                        <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                    </a>
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
                {{ $companyQuota->links() }}<br>
                <a href="{{ route('admin.companyQuota.index') }}" class="btn btn-default">Kembali ke Daftar</a>
            </div>
        </div>

    </section>
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        function deleteQuota(a) {
            var company=a.getAttribute('data-company');
            var pivot=a.getAttribute('data-pivot');
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus kuota perusahaan ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                location.href='/admin/companyQuota/'+company+'/delete/'+pivot;
            });
        }
    </script>
@endpush