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

<div class="form-group">
    <label class="control-label">Negara, Kabupaten/Kota, Kecamatan</label>
    <div class="row">
    <div class="col-sm-4">
        <select name="country_id" class="form-control select2">
            @foreach($countries as $key => $country)
            <option value="{{ $key }}">{{ $country }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-4">
        <select name="province_id" class="form-control select2">
            @foreach($provinces as $key => $province)
                <option value="{{ $key }}">{{ $province }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-4">
        <input type="text" class="form-control" value="{{ old('company_address', array_get($company, 'company_address')) }}">
    </div>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Alamat Perusahaan</label>
    <div class="col-sm-14">
        <input type="text" class="form-control" value="{{ old('company_address', array_get($company, 'company_address')) }}">
    </div>
</div>

<div class="form-group">
    <label class="control-label">Alamat Email</label>
    <div class="col-sm-14">
        <input type="email" class="form-control" value="{{ old('company_email', array_get($company, 'company_email')) }}">
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nomor Fax</label>
    <div class="col-sm-14">
        <input type="text" class="form-control" value="{{ old('company_fax', array_get($company, 'company_fax')) }}">
    </div>
</div>

<div class="form-group">
    <label class="control-label">Status Verifikasi</label>
    <div class="col-sm-14">

    </div>
</div>

