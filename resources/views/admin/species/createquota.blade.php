@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Kuota Ekspor Nasional Spesies & HS</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Tambah Kuota Ekspor Nasional Species {{$species->species_indonesia_name}}</h2>
                    <small class="card-subtitle">({{$species->species_scientific_name}})</small>
                </div>
                <div class="card-block">

                    @include('includes.notifications')

                    <form action="{{route('admin.species.createquota', ['species_id' => $species->id])}}" method="post" enctype="application/x-www-form-urlencoded" class="form-horizontal">
                        {!! csrf_field() !!}

                        @include('admin.species._formquota', ['species' => $species, 'quota' => null])

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-primary">Simpan Baru</button>
                                <a href="{{ route('admin.species.showquota', ['species_id'=> $species->id]) }}" class="btn btn-default">Batal</a>
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