@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Tipe Identitas</h1>
            </header>

            <div class="card">
                 <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Tambah Tipe Identitas</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">

                    @include('includes.notifications')

                    <form action="{{ route('admin.typeIdentify.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        {!! csrf_field() !!}

                        @include('admin.typeIdentify._form', ['type_identify' => null])

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-primary">Simpan Baru</button>
                                <a href="{{ route('admin.typeIdentify.index') }}" class="btn btn-default">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

