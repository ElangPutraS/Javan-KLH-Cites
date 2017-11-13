@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Edit Pelaku Usaha</h1>
        </header>

        <div class="card">
            <div class="card-block">
                <form action="{{ route('admin.companies.update', $company) }}" method="post" enctype="application/x-www-form-urlencoded" class="form-horizontal">
                    {!! csrf_field() !!}

                    @include('admin.companies._form')
                </form>
            </div>
        </div>
    </section>
@endsection