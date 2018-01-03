@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Kelola Kuota Ekspor Perusahaan</h1>
        </header>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Daftar Kuota Ekspor Perusahaan</h2>
                <small class="card-subtitle"></small>
            </div>

            <div class="card-block">
                <form method="post" enctype="multipart/form-data" class="form-inline" id="form-search">
                    <div class="input-group col-sm-6">
                        <span class="input-group-addon" id="basic-month">Nama Perusahaan</span>
                        <input class="form-control" type="text" placeholder="Cari nama perusahaan.." name="company_name" id="company_name" value="@if(Request::input('company_name')){{Request::input('company_name')}} @endif">
                    </div>

                    <div class="btn-group col-sm-1" role="group" aria-label="...">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari
                        </button>
                    </div>
                </form><br>
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
                {{ $companies->appends(\Illuminate\Support\Facades\Input::except('page'))->render('vendor.pagination.bootstrap-4') }}<br>
            </div>
        </div>

    </section>
@endsection
@push('body.script')
    <script>
        $(document).ready(function () {
            $('#form-search').submit(function (ev) {
                ev.preventDefault();

                var company_name = $('#company_name').val();

                location.href = '?company_name=' + company_name;
            });
        });
    </script>
@endpush