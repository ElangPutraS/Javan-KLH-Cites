@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Upload Data Master</h1>
            </header>

            <div class="card">

                <div class="card-header">
                    <h2 class="card-title">Upload Kategori Species</h2>
                    <small class="card-subtitle"></small>
                </div>

                <div class="card-block">
                    <label class="control-label" for="upload">Form Kategori Species</label> <br>
                    <a href="{{ URL::to('admin/downloadFormCategory/xlsx') }}" name="upload"><button class="btn btn-success">Download</button></a>
                    <hr>
                    <form action="{{ URL::to('admin/importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="import_file">Upload Kategori Species</label>
                        <br>
                        <input type="file" name="import_file" id="import_file"/>
                        <button class="btn btn-primary">Import File</button>
                    </form>
                </div>
            </div>

            <div class="card">

                <div class="card-header">
                    <h2 class="card-title">Upload Species</h2>
                    <small class="card-subtitle"></small>
                </div>

                <div class="card-block">
                    <label class="control-label" for="upload">Form Species</label> <br>
                    <a href="{{ URL::to('admin/downloadFormSpecies/xlsx') }}"><button class="btn btn-success">Download</button></a>
                    <hr>
                    <form action="{{ URL::to('admin/importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="import_file">Upload Species</label>
                        <br>
                        <input type="file" name="import_file" id="import_file"/>
                        <button class="btn btn-primary">Import File</button>
                    </form>

                </div>
            </div>

            <div class="card">

                <div class="card-header">
                    <h2 class="card-title">Upload Quota Species</h2>
                    <small class="card-subtitle"></small>
                </div>

                <div class="card-block">

                    <a href="{{ URL::to('admin/downloadQuota/xlsx') }}"><button class="btn btn-success">Download</button></a>
                    <hr>
                    <form action="{{ URL::to('admin/importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="import_file">Upload Kuota Species</label>
                        <br>
                        <input type="file" name="import_file" id="import_file"/>
                        <button class="btn btn-primary">Import File</button>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection
