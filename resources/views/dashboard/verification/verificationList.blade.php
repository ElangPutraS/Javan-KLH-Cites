@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Verification List</h1>
        </header>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Daftar Verifikasi Akun</h2>
                <small class="card-subtitle"></small>
            </div>

            <div class="card-block">
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
                        @foreach($company as $key=>$com)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{Carbon\Carbon::parse($com->created_at)->format('d-m-Y')}}</td>
                            <td>{{$com->userProfile->user->name}}</td>
                            <td>{{$com->company_name}}</td>
                            <td>
                                @if($com->company_status == 0)
                                    Menunggu Verifikasi
                                @else
                                    Disetujui
                                @endif
                            </td>
                            <td><a href="#"><i class="zmdi zmdi-book zmdi-hc-fw" title="detail"></i></a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
@endsection
