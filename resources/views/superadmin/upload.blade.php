@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Upload Data Master</h1>
            </header>
            @include('includes.notifications')
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Upload Kategori Species</h2>
                    <small class="card-subtitle"></small>
                </div>

                <div class="card-block">
                    <label class="control-label" for="upload">Form Kategori Species</label> <br>
                    <a onclick="ImportCategory()" href="{{ URL::to('admin/downloadFormCategory/xlsx') }}" name="upload"><button class="btn btn-success">Download</button></a>
                    <hr>
                    <form action="{{ URL::to('admin/importCategory') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="file_category">Upload Kategori Species</label>
                        <br>
                        <input disabled type="file" name="import_file" id="file_category"/>
                        <button disabled class="btn btn-primary" id="import_category">Import File</button>
                    </form>
                </div>
            </div>

            <div class="card">

                <div class="card-header">
                    <h2 class="card-title">Upload Species</h2>
                    <small class="card-subtitle"></small>
                </div>

                <div class="card-block">
                    <label class="control-label" for="upload">Form Species</label>
                    <br>
                    <a onclick="ImportSpecies()" href="{{ URL::to('admin/downloadFormSpecies/xlsx') }}"><button class="btn btn-success">Download</button></a>
                    <hr>
                    <form action="{{ URL::to('admin/importSpecies') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="file_species">Upload Species</label>
                        <br>
                        <input disabled type="file" name="import_file" id="file_species"/>
                        <button disabled class="btn btn-primary" id="import_species">Import File</button>
                    </form>

                </div>
            </div>

            <div class="card">

                <div class="card-header">
                    <h2 class="card-title">Upload Quota Species</h2>
                    <small class="card-subtitle"></small>
                </div>

                <div class="card-block">

                    <a onclick="ImportQuota()" href="{{ URL::to('admin/downloadFormQuota/xlsx') }}"><button class="btn btn-success">Download</button></a>
                    <hr>
                    <form action="{{ URL::to('admin/importQuota') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="file_quota">Upload Kuota Species</label>
                        <br>
                        <input disabled type="file" name="import_file" id="file_quota"/>
                        <button disabled class="btn btn-primary" id="import_quota">Import File</button>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection
@push('body.script')
    <script>
        function ImportCategory() {
            $("#file_category").removeAttr('disabled');
            $("#import_category").removeAttr('disabled');
        }

        function ImportSpecies() {
            $("#file_species").removeAttr('disabled');
            $("#import_species").removeAttr('disabled');
        }

        function ImportQuota() {
            $("#file_quota").removeAttr('disabled');
            $("#import_quota").removeAttr('disabled');
        }

    </script>
@endpush
