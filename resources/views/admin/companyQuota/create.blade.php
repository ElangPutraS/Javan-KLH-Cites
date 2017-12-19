@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Kuota Spesies & HS</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Tambah Kuota Perusahaan</h2>
                    <small class="card-subtitle">({{$company->company_name}})</small>
                </div>
                <div class="card-block">

                    @include('includes.notifications')

                    <form action="{{route('admin.companyQuota.store', ['id' => $company->id])}}" method="post" enctype="application/x-www-form-urlencoded" class="form-horizontal" id="form-quota">
                        {!! csrf_field() !!}

                        @include('admin.companyQuota._form', ['company' => $company, 'quota' => null])

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-primary">Simpan Baru</button>
                                <a href="{{ route('admin.companyQuota.detail', ['id'=> $company->id]) }}" class="btn btn-default">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('body.script')
@endpush