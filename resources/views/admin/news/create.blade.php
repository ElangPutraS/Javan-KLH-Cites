@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Tambah Informasi</h1>
            </header>

            <div class="card">
                <div class="card-block">

                    @include('includes.notifications')

                    <form action="{{ route('admin.news.store') }}" method="post" enctype="application/x-www-form-urlencoded" class="form-horizontal">
                        {!! csrf_field() !!}

                        @include('admin.news._form', ['news' => null])

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-primary">Simpan Baru</button>
                                <a href="{{ route('admin.news.index') }}" class="btn btn-default">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection