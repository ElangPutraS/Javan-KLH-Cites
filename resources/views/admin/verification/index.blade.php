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
                <form method="post" enctype="multipart/form-data" class="form-inline" id="form-search">
                    <div class="input-group col-sm-5">
                        <span class="input-group-addon" id="basic-year">Nama Pemilik Usaha</span>
                        <input class="form-control" placeholder="Cari nama pemilik usaha.." type="text" name="owner_name" id="owner_name" value="@if(Request::input('owner_name')){{Request::input('owner_name')}} @endif">
                    </div>

                    <div class="input-group col-sm-5">
                        <span class="input-group-addon" id="basic-month">Nama Perusahaan</span>
                        <input class="form-control" type="text" placeholder="Cari nama perusahaan.." name="company_name" id="company_name" value="@if(Request::input('company_name')){{Request::input('company_name')}} @endif">
                    </div><br><br><br>

                    <div class="input-group col-sm-5">
                        <span class="input-group-addon" id="basic-year">Tanggal Pendaftaran (dari)</span>
                        <input class="form-control date-picker flatpickr-input active" placeholder="dari tanggal.." type="text" name="date_from" id="date_from" value="@if(Request::input('date_from')){{Request::input('date_from')}} @endif">
                    </div>

                    <div class="input-group col-sm-5">
                        <span class="input-group-addon" id="basic-year">Tanggal Pendaftaran (sampai)</span>
                        <input class="form-control date-picker flatpickr-input active" placeholder="sampai tanggal.." type="text" name="date_until" id="date_until" value="@if(Request::input('date_until')){{Request::input('date_until')}} @endif">
                    </div>

                    <div class="btn-group col-sm-2" role="group" aria-label="...">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>&nbsp;&nbsp;&nbsp;
                        <button type="reset" class="btn btn-danger" id="form-reset"> Reset Pencarian</button>
                    </div>
                </form><br>
                @include('includes.notifications')

                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-default">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Register</th>
                            <th>Nama Pemilik Usaha</th>
                            <th>Nama Usaha</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($companies as $company)
                        <tr>
                            <td>{{ (($companies->currentPage() - 1 ) * $companies->perPage() ) + $loop->iteration }}</td>
                            <td>{{Carbon\Carbon::parse($company->created_at)->format('d-m-Y')}}</td>
                            <td>{{$company->owner_name}}</td>
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
                        @empty
                            <td colspan="6"><center>Data Kosong</center></td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $companies->appends(\Illuminate\Support\Facades\Input::except('page'))->render('vendor.pagination.bootstrap-4') }}
            </div>
        </div>

    </section>
@endsection
@push('body.script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#form-search').submit(function (ev) {
                ev.preventDefault();

                var company_name = $('#company_name').val();
                var owner_name = $('#owner_name').val();
                var date_from = $('#date_from').val();
                var date_until = $('#date_until').val();

                location.href = '?company_name=' + company_name + '&owner_name=' + owner_name + '&date_from=' + date_from + '&date_until=' + date_until;
            });

            $('#form-reset').click(function (ev) {
                ev.preventDefault();

                location.href = '?company_name=&owner_name=&date_from=&date_until=';
            });
        });

    </script>
@endpush