<div class="form-group">
    <h3>Data Akun</h3>
</div>
<div class="form-group">
    <label class="control-label">Nama</label>
    <div class="col-sm-14">
        @if(count($company)!=0)
            <input type="text" name="name" class="form-control" value="{{ old('name', array_get($company->userProfile->user, 'name')) }}">
        @else
            <input type="text" name="name" class="form-control" value="{{ old('name', array_get($company, 'name')) }}">
        @endif
    </div>
</div>

<div class="form-group">
    <label class="control-label">Email</label>
    <div class="col-sm-14">
        @if(count($company)!=0)
            <input type="email" name="email" class="form-control" value="{{ old('email', array_get($company->userProfile->user, 'email')) }}">
        @else
            <input type="email" name="email" class="form-control" value="{{ old('email', array_get($company, 'email')) }}">
        @endif
    </div>
</div>

@if(count($company)==0)
<div class="form-group">
    <label class="control-label">Password</label>
    <div class="col-sm-14">
        <input type="password" name="password" class="form-control" value="{{ old('password', array_get($company, 'password')) }}">
    </div>
</div>
@endif

<div class="form-group">
    <h3>Data Pelaku Usaha</h3>
</div>
<div class="form-group">
    <label class="control-label">Tempat Lahir, Tanggal Lahir</label>
    <div class="row">
        <div class="col-sm-5">
            @if(count($company)!=0)
                <input type="text" name="place_birth" class="form-control" value="{{ old('place_birth', array_get($company->userProfile, 'place_of_birth')) }}">
            @else
                <input type="text" name="place_birth" class="form-control" value="{{ old('place_birth', array_get($company, 'place_of_birth')) }}">
            @endif
        </div>
        <div class="col-sm-5">
            @if(count($company)!=0)
                <input type="text" class="form-control date-picker flatpickr-input active" placeholder="Pilih Tanggal" name="date_birth" class="form-control" value="{{ old('date_birth', array_get($company->userProfile, 'date_of_birth')) }}">
            @else
                <input type="text" class="form-control date-picker flatpickr-input active" placeholder="Pilih Tanggal" name="date_birth" class="form-control" value="{{ old('date_birth', array_get($company, 'date_of_birth')) }}">
            @endif
        </div>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nomor Telepon</label>
    <div class="col-sm-14">
        @if(count($company)!=0)
            <input type="text" name="mobile" class="form-control" value="{{ old('mobile', array_get($company->userProfile, 'mobile')) }}">
        @else
            <input type="text" name="mobile" class="form-control" value="{{ old('mobile', array_get($company, 'mobile')) }}">
        @endif
    </div>
</div>

<div class="form-group">
    <label class="control-label">Alamat Perusahaan</label>
    <div class="col-sm-14">
        @if(count($company)!=0)
            <input type="text" name="address" class="form-control" value="{{ old('address', array_get($company->userProfile, 'address')) }}">
        @else
            <input type="text" name="address" class="form-control" value="{{ old('address', array_get($company, 'address')) }}">
        @endif
    </div>
</div>

<div class="form-group">
    <label class="control-label">Negara, Kabupaten/Kota, Kecamatan Pelaku Usaha</label>
    <div class="row">
        <div class="col-sm-4">
            <select name="country_id" class="form-control select2">
                @foreach($countries as $key => $country)
                    @if(count($company)!=0)
                        <option value="{{ $key }}" {{ $key === old('country_id', array_get($company->userProfile, 'country_id')) ? 'selected' : '' }}>{{ $country }}</option>
                    @else
                        <option value="{{ $key }}" {{ $key === old('country_id', array_get($company, 'country_id')) ? 'selected' : '' }}>{{ $country }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-sm-4">
            <select name="province_id" class="form-control select2">
                @foreach($provinces as $key => $province)
                    @if(count($company)!=0)
                        <option value="{{ $key }}" {{ $key === old('province_id', array_get($company->userProfile, 'province_id')) ? 'selected' : '' }}>{{ $province }}</option>
                    @else
                        <option value="{{ $key }}" {{ $key === old('province_id', array_get($company, 'province_id')) ? 'selected' : '' }}>{{ $province }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-sm-4">
            <select name="city_id" class="form-control select2">
                @foreach($cities as $key => $city)
                    @if(count($company)!=0)
                        <option value="{{ $key }}" {{ $key === old('city_id', array_get($company->userProfile, 'city_id')) ? 'selected' : '' }}>{{ $city }}</option>
                    @else
                        <option value="{{ $key }}" {{ $key === old('city_id', array_get($company, 'city_id')) ? 'selected' : '' }}>{{ $city }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <h3>Data Perusahaan</h3>
</div>
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
    <label class="control-label">Negara, Kabupaten/Kota, Kecamatan Perusahaan</label>
    <div class="row">
    <div class="col-sm-4">
        <select name="company_country_id" class="form-control select2">
            @foreach($countries as $key => $country)
                <option value="{{ $key }}" {{ $key === old('company_country_id', array_get($company, 'country_id')) ? 'selected' : '' }}>{{ $country }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-4">
        <select name="company_province_id" class="form-control select2">
            @foreach($provinces as $key => $province)
                <option value="{{ $key }}" {{ $key === old('company_province_id', array_get($company, 'province_id')) ? 'selected' : '' }}>{{ $province }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-4">
        <select name="company_city_id" class="form-control select2">
            @foreach($cities as $key => $city)
            <option value="{{ $key }}" {{ $key === old('company_city_id', array_get($company, 'city_id')) ? 'selected' : '' }}>{{ $city }}</option>
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
    <label class="control-label">Lokasi</label>
    <div class="col-sm-14">
        <div id="map" style="width: 100%; height: 300px;"></div>
        <input id="company_latitude" type="hidden" name="company_latitude" value="{{ old('company_latitude', array_get($company, 'company_latitude')) }}">
        <input id="company_longitude" type="hidden"  name="company_longitude" value="{{ old('company_longitude', array_get($company, 'company_longitude')) }}" required>
    </div>
</div>
