<div class="form-group">
    <label class="control-label">HS Code</label>
    <div class="col-sm-14">
        <input type="text" name="hs_code" class="form-control" value="{{ old('hs_code', array_get($species, 'hs_code')) }}" required>
    </div>
</div>

<div class="form-group">
    <label class="control-label">SP Code</label>
    <div class="col-sm-14">
        <input type="text" name="sp_code" class="form-control" value="{{ old('sp_code', array_get($species, 'sp_code')) }}" required>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nama Ilmiah</label>
    <div class="col-sm-14">
        <input type="text" name="scientific_name" class="form-control" value="{{ old('scientific_name', array_get($species, 'species_scientific_name')) }}" required>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nama Lokal</label>
    <div class="col-sm-14">
        <input type="text" name="indonesia_name" class="form-control" value="{{ old('indonesia_name', array_get($species, 'species_indonesia_name')) }}" required>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nama Umum</label>
    <div class="col-sm-14">
        <input type="text" name="general_name" class="form-control" value="{{ old('general_name', array_get($species, 'species_general_name')) }}" required>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Memiliki Appendiks ?</label>
    <div class="col-sm-14">
        <div class="btn-group btn-group--colors" data-toggle="buttons" id="is_appendix">
            <label class="btn bg-light-blue waves-effect {{ '1' == old('is_appendix', array_get($species, 'is_appendix')) ? 'active' : '' }}"><input type="radio" id="is_appendix1" name="is_appendix" value="1" autocomplete="off" {{ '1' == old('is_appendix', array_get($species, 'is_appendix')) ? 'checked' : '' }} required></label>Ya &nbsp;&nbsp;&nbsp;
            <label class="btn bg-red waves-effect {{ '0' == old('is_appendix', array_get($species, 'is_appendix')) ? 'active' : '' }}"><input type="radio" id="is_appendix2" name="is_appendix" value="0" autocomplete="off" {{ '0' == old('is_appendix', array_get($species, 'is_appendix')) ? 'checked' : '' }} required></label>Tidak
        </div>
    </div>
</div>

<div class="form-group" id="showAppendix" style="display:{{'1' == old('is_appendix', array_get($species, 'is_appendix')) ? 'active' : 'none' }};">
    <label class="control-label">Appendiks</label>
    <div class="col-sm-14">
        <select name="appendix_source_id" id="appendix_source_id" class="form-control select2"  @if($species!==NULL) @if($species->is_appendix===1) required @endif @endif>
            <option value="">--Pilih Appendiks--</option>
            @foreach($appendix as $key => $append)
                <option value="{{ $key }}" {{ $key == old('appendix_source_id', array_get($species, 'appendix_source_id')) ? 'selected' : '' }}>{{ $append }}</option>
            @endforeach
        </select>
    </div>
</div>


<div class="form-group" id="showSourceAppendix" >
    <label class="control-label">Sumber Appendiks</label>
    <div class="col-sm-14">
        <select name="source_id" id="source_id" class="form-control select2" required>
            <option value="">--Pilih Sumber Appendiks--</option>
            @foreach($sources as $source)
                <option value="{{ $source->id }}" {{ $source->id == old('source_id', array_get($species, 'source_id')) ? 'selected' : '' }}>{{ $source->source_code.' - '.$source->source_description }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Komoditas Spesies</label>
    <div class="col-sm-14">
        <select name="species_category_id" id="species_category_id" class="form-control select2" required>
            <option value="">--Pilih Komoditas Spesies--</option>
            @foreach($categories as $key => $category_name)
                <option value="{{ $key }}" {{ $key == old('species_category_id', array_get($species, 'species_category_id')) ? 'selected' : '' }}>{{ $category_name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Deskripsi</label>
    <div class="col-sm-14">
        <textarea id="description" name="description" type="text" class="form-control" >{{ old('description', array_get($species, 'species_description')) }}</textarea>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Satuan</label>
    <div class="col-sm-14">
        <select name="unit_id" id="unit_id" class="form-control select2" required>
            <option value="">--Pilih Satuan--</option>
            @foreach($units as $unit)
                <option value="{{ $unit->id }}" {{ $unit->id == old('unit_id', array_get($species, 'unit_id')) ? 'selected' : '' }}>{{ $unit->unit_code.' - '.$unit->unit_description }}</option>
            @endforeach
        </select>
    </div>
</div>


<div class="form-group">
    <label class="control-label">Nominal</label>
    <div class="col-sm-14">
        <input id="nominal" name="nominal" type="text" class="form-control input-mask" data-mask="000.000.000" placeholder="eg: 000.000,00" maxlength="9" value="{{ old('nominal', array_get($species, 'nominal')) }}">
    </div>
</div>

