@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Tambah Pelaku Usaha Baru</h1>
        </header>

        <div class="card">
            <div class="card-block">
                <form action="{{ route('admin.companies.store') }}" method="post" enctype="application/x-www-form-urlencoded" class="form-horizontal">
                    {!! csrf_field() !!}

                    @include('admin.companies._form')
                </form>
            </div>
        </div>
    </section>
@endsection