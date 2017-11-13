<div class="form-group">
    <label class="control-label">Nama Perusahaan</label>
    <div class="col-sm-14">
        <input type="text" name="company_name" class="form-control" value="{{ old('company_name', array_get($company, 'company_name')) }}">
    </div>
</div>

<div class="form-group">
    <label class="control-label">Alamat Perusahaan</label>
    <div class="col-sm-14">
        <input type="text" name="company_address" class="form-control" value="{{ old('company_address', array_get($company, 'company_address')) }}">
    </div>
</div>

<div class="form-group">
    <label class="control-label">Negara, Kabupaten/Kota, Kecamatan</label>
    <div class="row">
    <div class="col-sm-4">
        <select name="country_id" class="form-control select2">
            @foreach($countries as $key => $country)
            <option value="{{ $key }}" {{ $key === old('country_id', array_get($company, 'country_id')) ? 'selected' : '' }}>{{ $country }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-4">
        <select name="province_id" class="form-control select2">
            @foreach($provinces as $key => $province)
            <option value="{{ $key }}" {{ $key === old('province_id', array_get($company, 'province_id')) ? 'selected' : '' }}>{{ $province }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-4">
        <select name="province_id" class="form-control select2">
            @foreach($cities as $key => $city)
            <option value="{{ $key }}" {{ $key === old('city_id', array_get($company, 'city_id')) ? 'selected' : '' }}>{{ $city }}</option>
            @endforeach
        </select>
    </div>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Alamat Email</label>
    <div class="col-sm-14">
        <input type="email" name="company_email" class="form-control" value="{{ old('company_email', array_get($company, 'company_email')) }}">
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nomor Fax</label>
    <div class="col-sm-14">
        <input type="text" name="company_fax" class="form-control" value="{{ old('company_fax', array_get($company, 'company_fax')) }}">
    </div>
</div>

<div class="form-group">
    <label class="control-label">Status Verifikasi</label>
    <div class="col-sm-14">
        @php($statuses = [0 => 'Menunggu Verifikasi', 1 => 'Disetujui', 2 => 'Ditolak'])

        <select name="company_status" class="form-control select2">
            @foreach($statuses as $key => $status)
                <option value="{{ $key }}" {{ $key === old('company_status', array_get($company, 'company_status')) ? 'selected' : '' }}>{{ $status }}</option>
            @endforeach
        </select>
    </div>
</div>


<div class="form-group">
    <label class="control-label">Akun Pengguna</label>
    <div class="col-sm-14">
        <select name="user_id" class="form-control select2">
            @foreach($users as $key => $user)
                <option value="{{ $key }}" {{ $key === old('user_id', array_get($company, 'user_id')) ? 'selected' : '' }}>{{ $user }}</option>
            @endforeach
        </select>
    </div>
</div>
