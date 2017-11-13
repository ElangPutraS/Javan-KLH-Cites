<div class="form-group">
    <label class="control-label">Nama Perusahaan</label>
    <div class="col-sm-14">
        <input type="text" class="form-control" value="{{ old('company_name', array_get($company, 'company_name')) }}">
    </div>
</div>
<div class="form-group">
    <label class="control-label">Alamat Perusahaan</label>
    <div class="col-sm-14">
        <input type="text" class="form-control" value="{{ old('company_address', array_get($company, 'company_address')) }}">
    </div>
</div>
