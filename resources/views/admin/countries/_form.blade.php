<div class="form-group">
    <label class="control-label">Kode Negara</label>
    <div class="col-sm-14">
            <input type="text" name="country_code" class="form-control" value="{{ old('country_code', array_get($country, 'country_code')) }}">
    </div>
</div>


<div class="form-group">
    <label class="control-label">Nama Negara</label>
    <div class="col-sm-14">

            <input type="text" name="country_name" class="form-control" value="{{ old('country_name', array_get($country, 'country_name')) }}">

    </div>
</div>


