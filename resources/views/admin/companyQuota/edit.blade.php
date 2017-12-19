@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Kuota Spesies & HS</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Ubah Kuota Spesies Perusahaan</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">

                    @include('includes.notifications')

                    <form action="{{route('admin.companyQuota.update', ['company' => $company->id, 'id' => $quota->id]) }}" method="post" class="form-horizontal" id="form-quota">
                        {!! csrf_field() !!}

                        @include('admin.companyQuota._form', ['company' => $company, 'quota' => $quota])

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.companyQuota.detail', ['id'=> $company->id]) }}" class="btn btn-default">Kembali ke Daftar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection