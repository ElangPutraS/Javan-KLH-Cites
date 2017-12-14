@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Kelola Kuota Species Perusahaan</h1>
        </header>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Daftar Kuota Species Perusahaan</h2>
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
                            <th>Jumlah Kuota Spesies</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($companies as $company)
                            <tr>
                                <td>{{ (($companies->currentPage() - 1 ) * $companies->perPage() ) + $loop->iteration }}</td>
                                <td>{{$company->company_name}}</td>
                                <td>{{$company->companyQuota->count()}} kuota spesies</td>
                                <td>
                                    <a href="{{ route('admin.companyQuota.detail', ['id' => $company->id]) }}" class="btn btn-sm btn-info"><i class="zmdi zmdi-book zmdi-hc-fw" title="detail"></i></a>
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
                {{ $companies->links() }}<br>
            </div>
        </div>

    </section>
@endsection
