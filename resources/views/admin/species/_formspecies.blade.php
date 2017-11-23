<div class="form-group">
    <h3>Form Species</h3>
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
    <label class="control-label">Appendix</label>
    <div class="col-sm-14">
        <select name="appendix_source_id" id="appendix_source_id" class="form-control select2">
            <option value="">--Pilih Appendix Source--</option>
            @foreach($appendix as $key => $append)
                <option value="{{ $key }}" {{ $key == old('appendix_source_id', array_get($species, 'appendix_source_id')) ? 'selected' : '' }}>{{ $append }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Jenis Kelamin Species</label>
    <div class="col-sm-14">
        <select name="species_sex_id" id="species_sex_id" class="form-control select2" required>
            <option value="">--Pilih Species Sex--</option>
            @foreach($species_sex as $key => $sex_name)
                <option value="{{ $key }}" {{ $key == old('species_sex_id', array_get($species, 'species_sex_id')) ? 'selected' : '' }}>{{ $sex_name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Kategori Species</label>
    <div class="col-sm-14">
        <select name="species_category_id" id="species_category_id" class="form-control select2" required>
            <option value="">--Pilih Species Category--</option>
            @foreach($categories as $key => $category_name)
                <option value="{{ $key }}" {{ $key == old('species_category_id', array_get($species, 'species_category_id')) ? 'selected' : '' }}>{{ $category_name }}</option>
            @endforeach
        </select>
    </div>
</div>
