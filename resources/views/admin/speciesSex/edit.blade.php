@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Jenis Kelamin Spesies</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Ubah Data Jenis Kelamin</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">

                    @include('includes.notifications')

                    <form action="{{ route('admin.speciesSex.update', $speciessex) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        {{ method_field('PUT') }}

                        {!! csrf_field() !!}

                        @include('admin.speciesSex._form', ['speciessex'=> $speciessex])

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.speciesSex.index') }}" class="btn btn-default">Kembali ke Daftar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
