@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Edit Kelola Informasi</h1>
            </header>

            <div class="card">
                <div class="card-block">

                    @include('includes.notifications')

                    <form action="{{ route('admin.news.update', $news) }}" method="post" enctype="application/x-www-form-urlencoded" class="form-horizontal">
                        {{ method_field('PUT') }}

                        {!! csrf_field() !!}

                        @include('admin.news._form', ['news' => $news , 'disable' =>true])

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <a href="{{ route('admin.news.index') }}" class="btn btn-primary">Kembali ke Daftar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection