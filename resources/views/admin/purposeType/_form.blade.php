<div class="form-group">
    <h3>Data Purpose Type</h3>
</div>

<div class="form-group">
    <label class="control-label">Kode Purpose Type</label>
    <div class="col-sm-14">
            <input type="text" name="purpose_type_code" class="form-control" value="{{ old('purpose_type_code', array_get($purposetype, 'purpose_type_code')) }}">
    </div>
</div>


<div class="form-group">
    <label class="control-label">Nama Purpose Type</label>
    <div class="col-sm-14">
            <input type="text" name="purpose_type_name" class="form-control" value="{{ old('purpose_type_name', array_get($purposetype, 'purpose_type_name')) }}">
    </div>
</div>


