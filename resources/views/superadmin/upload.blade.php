@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Upload Data Master</h1>
            </header>

            <div class="card">

                <div class="card-header">
                    <h2 class="card-title">Upload Data Species</h2>
                    <small class="card-subtitle"></small>
                </div>

                <div class="card-block">

                    @include('includes.notifications')

                    <a href="{{ URL::to('admin/downloadFormSpecies/xlsx') }}"><button class="btn btn-success">Download Form Species</button></a>
                    <hr>

                </div>
            </div>

            <div class="card">

                <div class="card-header">
                    <h2 class="card-title">Update Quota Species</h2>
                    <small class="card-subtitle"></small>
                </div>

                <div class="card-block">

                    @include('includes.notifications')

                    <a href="{{ URL::to('admin/downloadQuota/xlsx') }}"><button class="btn btn-success">Download Kuota Species</button></a>
                    <hr>
                    <form action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <label for="import_file">Upload Kuota Species</label>
                        <br>
                        <input type="file" name="import_file" />
                        <button class="btn btn-primary">Import File</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
