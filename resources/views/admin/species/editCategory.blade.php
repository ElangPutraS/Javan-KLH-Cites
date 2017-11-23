@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Edit Species</h1>
            </header>

            <div class="card">
                <div class="card-block">

                    @include('includes.notifications')

                    <form action="{{route('admin.species.updateCategory', ['id' => Request::segment(3)])}}" method="post" enctype="application/x-www-form-urlencoded" class="form-horizontal">

                        {!! csrf_field() !!}
                        @include('admin.species._formcategory', ['categories' => $categories])

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{route('admin.species.category')}}" class="btn btn-default">Kembali ke Daftar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
