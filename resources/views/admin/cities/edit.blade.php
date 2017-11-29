@extends('dashboard.layouts.base')

@section('content')
	<section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Edit Kabupaten/Kota</h1>
            </header>

            <div class="card">
                <div class="card-block">

                    @include('includes.notifications')

                    <form action="{{ route('admin.cities.update', $city) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        {{ method_field('PUT') }}

                        {!! csrf_field() !!}

                        @include('admin.cities._form', ['city' => $city])

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.cities.index') }}" class="btn btn-default">Kembali ke Daftar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
