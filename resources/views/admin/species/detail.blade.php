
@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Spesies & HS</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Detail Spesies & HS</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">

                    @include('includes.notifications')

                    <form action="" method="post" enctype="application/x-www-form-urlencoded" class="form-horizontal">

                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="control-label">HS Code</label>
                            <div class="col-sm-14">
                                <input type="text" name="hs_code" class="form-control" value="{{ old('hs_code', array_get($species, 'hs_code')) }}" required readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">SP Code</label>
                            <div class="col-sm-14">
                                <input type="text" name="sp_code" class="form-control" value="{{ old('sp_code', array_get($species, 'sp_code')) }}" required readonly>
                            </div>
                        </div>

                        @if($species->is_appendix === 1)
                            <div class="form-group">
                                <label class="control-label">Appendiks</label>
                                <div class="col-sm-14">
                                    <input type="text" name="appendix_name" class="form-control" value="{{ old('appendix_name', array_get($species->appendixSource, 'appendix_source_code')) }}" required readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Sumber Appendiks</label>
                                <div class="col-sm-14">
                                    <textarea type="text" name="source_name" class="form-control" value="" required readonly>{{ old('source_name', array_get($species->source, 'source_description')) }}</textarea>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label class="control-label">Appendiks</label>
                                <div class="col-sm-14">
                                    <input type="text" name="appendix_name" class="form-control" value="Non-Appendix" required readonly>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="control-label">Nama Ilmiah</label>
                            <div class="col-sm-14">
                                <input type="text" name="scientific_name" class="form-control" value="{{ old('scientific_name', array_get($species, 'species_scientific_name')) }}" required readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Nama Lokal</label>
                            <div class="col-sm-14">
                                <input type="text" name="indonesia_name" class="form-control" value="{{ old('indonesia_name', array_get($species, 'species_indonesia_name')) }}" required readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Nama Umum</label>
                            <div class="col-sm-14">
                                <input type="text" name="general_name" class="form-control" value="{{ old('general_name', array_get($species, 'species_general_name')) }}" required readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Deskripsi</label>
                            <div class="col-sm-14">
                                <input type="text" name="description" class="form-control" value="{{ old('description', array_get($species, 'species_description')) }}" required readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Satuan</label>
                            <div class="col-sm-14">
                                <input type="text" name="general_name" class="form-control" value="{{ old('general_name', array_get($species->unit, 'unit_description')) }}" required readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Nominal</label>
                            <div class="col-sm-14">
                                <input id="nominal" name="nominal" type="text" class="form-control input-mask" data-mask="000.000.000" placeholder="eg: 000.000,00" maxlength="9" value="{{ old('nominal', array_get($species, 'nominal')) }}"readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <a href="{{ route('admin.species.index') }}" class="btn btn-default">Kembali ke Daftar</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </section>
@endsection

