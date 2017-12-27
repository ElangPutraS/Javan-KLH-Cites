@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Verifikasi Pelaku Usaha</h1>
        </header>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Daftar Verifikasi Akun</h2>
                <small class="card-subtitle"></small>
            </div>

            <div class="card-block">

                @include('includes.notifications')

                <div class="table-responsive">
                    <table id="data-table" class="table table-bordered">
                        <thead class="thead-default">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Register</th>
                            <th>Nama Pelaku Usaha</th>
                            <th>Nama Usaha</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $company)
                        <tr>
                            <td>{{ (($companies->currentPage() - 1 ) * $companies->perPage() ) + $loop->iteration }}</td>
                            <td>{{Carbon\Carbon::parse($company->created_at)->format('d-m-Y')}}</td>
                            <td>{{$company->userProfile->user->name}}</td>
                            <td>{{$company->company_name}}</td>
                            <td>
                                @if($company->company_status == 0)
                                    <span class="badge badge-warning">Menunggu Verifikasi</span>
                                @elseif($company->company_status == 1)
                                    <span class="badge badge-success">Verifikasi Disetujui</span>
                                @else
                                    <span class="badge badge-danger">Verifikasi Ditolak</span>
                                @endif
                            </td>
                            <td><a href="{{route('admin.verification.show', ['id'=> $company->id])}}" class="btn btn-sm btn-info"><i class="zmdi zmdi-book zmdi-hc-fw" title="detail"></i></a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $companies->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>

    </section>
@endsection
