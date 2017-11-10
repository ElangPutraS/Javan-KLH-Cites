@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Dashboard</h1>
        </header>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Selamat Datang, {{ auth()->user()->name }}</h2>
                <small class="card-subtitle">Anda login sebagai: {{ auth()->user()->roles->first()->role_name }}</small>
            </div>

            <div class="card-block">

            </div>
        </div>
    </section>
@endsection