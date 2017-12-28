@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Kuota Ekspor Nasional Spesies & HS</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Ubah Kuota Ekspor Nasional Species {{$species->species_indonesia_name}}</h2>
                    <small class="card-subtitle">({{$species->species_scientific_name}})</small>
                </div>
                <div class="card-block">

                    @include('includes.notifications')

                    <form action="{{route('admin.species.updatequota', ['species_id' => $species->id, 'id' => $quota->id]) }}" method="post" class="form-horizontal">
                        {!! csrf_field() !!}

                        @include('admin.species._formquota', ['species' => $species, 'quota' => $quota])

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.species.showquota', ['species_id'=> $species->id]) }}" class="btn btn-default">Kembali ke Daftar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection