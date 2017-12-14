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
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-default">
                        <tr>
                            <th>No</th>
                            <th>Nama Species</th>
                            <th>Tahun</th>
                            <th>Jumlah Kuota</th>
                            <th>Jumlah yang telah terealisasi</th>
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
            </div>
        </div>

    </section>
@endsection