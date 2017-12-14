<div class="form-group">
    <h5>A. Data Akun</h5>
</div>

<div class="form-group">
    <label class="control-label">Nama</label>
    <div class="col-sm-14">
        <input type="text" name="name" max="190" class="form-control" value="{{ old('name', array_get($user, 'name')) }}" required>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Email</label>
    <div class="col-sm-14">
        <input type="email" name="email" class="form-control" value="{{ old('email', array_get($user, 'email')) }}" required>
    </div>
</div>

@can('access-pelaku-usaha')
<div class="form-group">
    <h5>B. Data Pemilik Usaha</h5>
</div>
<div class="form-group">
    <label class="control-label">Nama Pemilik Perusahaan</label>
    <div class="col-sm-14">
        <input type="text" name="owner_name" class="form-control" value="{{ old('owner_name', array_get($company, 'owner_name')) }}" required>
    </div>
</div>
<div class="form-group">
    <label class="control-label">Tempat Lahir, Tanggal Lahir</label>
    <div class="row">
        <div class="col-sm-5">
            @if(count($company)!=0)
                <input type="text" name="place_birth" class="form-control" value="{{ old('place_birth', array_get($company->userProfile, 'place_of_birth')) }}" required>
            @else
                <input type="text" name="place_birth" class="form-control" value="{{ old('place_birth', array_get($company, 'place_of_birth')) }}" required>
            @endif
        </div>
        <div class="col-sm-5">
            @if(count($company)!=0)
                <input type="text" class="form-control date-picker flatpickr-input active" placeholder="Pilih Tanggal" data-max-date="today" name="date_birth" class="form-control" value="{{ old('date_birth', array_get($company->userProfile, 'date_of_birth')) }}" required>
            @else
                <input type="text" class="form-control date-picker flatpickr-input active" placeholder="Pilih Tanggal" data-max-date="today" name="date_birth" class="form-control" value="{{ old('date_birth', array_get($company, 'date_of_birth')) }}" required>
            @endif
        </div>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nomor Telepon</label>
    <div class="col-sm-14">
        @if(count($company)!=0)
            <input type="text" name="mobile" class="form-control" value="{{ old('mobile', array_get($company->userProfile, 'mobile')) }}" required>
        @else
            <input type="text" name="mobile" class="form-control" value="{{ old('mobile', array_get($company, 'mobile')) }}" required>
        @endif
    </div>
</div>

<div class="form-group">
    <label class="control-label">Alamat Pelaku Usaha</label>
    <div class="col-sm-14">
        @if(count($company)!=0)
            <input type="text" name="address" class="form-control" value="{{ old('address', array_get($company->userProfile, 'address')) }}" required>
        @else
            <input type="text" name="address" class="form-control" value="{{ old('address', array_get($company, 'address')) }}" required>
        @endif
    </div>
</div>

<div class="form-group">
    <label class="control-label">Negara, Kabupaten/Kota, Kecamatan Pelaku Usaha</label>
    <div class="row">
        <div class="col-sm-4">
            <select name="country_id" id="country_id" class="form-control select2" onchange="getState(this)" required>
                <option value="">--Pilih Negara--</option>
                @foreach($countries as $key => $country)
                    @if(count($company)!=0)
                        <option value="{{ $key }}" {{ $key == old('country_id', array_get($company->userProfile, 'country_id')) ? 'selected' : '' }}>{{ $country }}</option>
                    @else
                        <option value="{{ $key }}" {{ $key == old('country_id', array_get($company, 'country_id')) ? 'selected' : '' }}>{{ $country }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-sm-4">
            <select name="province_id" id="province_id" class="form-control select2" onchange="getCity(this)" required>
                <option value="">--Pilih Provinsi--</option>
                @foreach($provinces as $key => $province)
                    @if(count($company)!=0)
                        <option value="{{ $key }}" {{ $key == old('province_id', array_get($company->userProfile, 'province_id')) ? 'selected' : '' }}>{{ $province }}</option>
                    @else
                        <option value="{{ $key }}" {{ $key == old('province_id', array_get($company, 'province_id')) ? 'selected' : '' }}>{{ $province }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-sm-4">
            <select name="city_id" id="city_id" class="form-control select2" required>
                <option value="">--Pilih Kota--</option>
                @foreach($cities as $key => $city)
                    @if(count($company)!=0)
                        <option value="{{ $key }}" {{ $key == old('city_id', array_get($company->userProfile, 'city_id')) ? 'selected' : '' }}>{{ $city }}</option>
                    @else
                        <option value="{{ $key }}" {{ $key == old('city_id', array_get($company, 'city_id')) ? 'selected' : '' }}>{{ $city }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Tipe Identitas</label>
    @if(count($company)!=0)
        <input type="hidden" name="old_type_identify" value="{{$company->userProfile->typeIdentify->first()->id}}">
    @endif
    <div class="col-sm-14">
        <select name="type_identify" id="type_identify" class="form-control select2" required>
            <option value="">--Pilih Tipe Identitas--</option>
            @foreach($identity_type as $key => $ident)
                @if(count($company)!=0)
                    <option value="{{ $key }}" {{ $key == old('type_identify', array_get($company->userProfile->typeIdentify->first(), 'id')) ? 'selected' : '' }}>{{ $ident }}</option>
                @else
                    <option value="{{ $key }}" {{ $key == old('type_identify', array_get($company, 'id')) ? 'selected' : '' }}>{{ $ident }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nomor Identitas</label>
    <div class="col-sm-14">
        @if(count($company)!=0)
            <input type="text" name="identity_number" class="form-control" value="{{ old('identity_number', array_get($company->userProfile->typeIdentify->first()->pivot, 'user_type_identify_number')) }}" required>
        @else
            <input type="text" name="identity_number" class="form-control" value="{{ old('identity_number', array_get($company, 'user_type_identify_number')) }}" required>
        @endif
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nomor NPWP Pemilik Perusahaan</label>
    <div class="col-sm-14">
        <input id="npwp_number_user" type="text" class="form-control" name="npwp_number_user" value="{{ old('npwp_number_user', array_get($user->userProfile, 'npwp_number')) }}" required>
    </div>
</div>

<div class="form-group">
    <h5>C. Data Perusahaan</h5>
</div>
<div class="form-group">
    <label class="control-label">Nama Perusahaan</label>
    <div class="col-sm-14">
        <input type="text" name="company_name" class="form-control" value="{{ old('company_name', array_get($company, 'company_name')) }}" required>
    </div>
</div>



<div class="form-group">
    <label class="control-label">Alamat Email</label>
    <div class="col-sm-14">
        <input type="email" name="company_email" class="form-control" value="{{ old('company_email', array_get($company, 'company_email')) }}" required>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nomor Fax</label>
    <div class="col-sm-14">
        <input type="text" name="company_fax" class="form-control" value="{{ old('company_fax', array_get($company, 'company_fax')) }}" required>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Alamat Perusahaan</label>
    <div class="col-sm-14">
        <input type="text" name="company_address" class="form-control" value="{{ old('company_address', array_get($company, 'company_address')) }}" required>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Negara, Kabupaten/Kota, Kecamatan Perusahaan</label>
    <div class="row">
        <div class="col-sm-4">
            <select name="company_country_id" id="company_country_id" class="form-control select2" onchange="getStateCompany(this)" required>
                <option value="">--Pilih Negara Perusahaan--</option>
                @foreach($countries as $key => $country)
                    <option value="{{ $key }}" {{ $key == old('company_country_id', array_get($company, 'country_id')) ? 'selected' : '' }}>{{ $country }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-4">
            <select name="company_province_id" id="company_province_id" class="form-control select2" onchange="getCityCompany(this)" required>
                <option value="">--Pilih Provinsi Perusahaan--</option>
                @foreach($provinces as $key => $province)
                    <option value="{{ $key }}" {{ $key == old('company_province_id', array_get($company, 'province_id')) ? 'selected' : '' }}>{{ $province }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-4">
            <select name="company_city_id" id="company_city_id" class="form-control select2" required>
                <option value="">--Pilih Kota Perusahaan--</option>
                @foreach($cities as $key => $city)
                    <option value="{{ $key }}" {{ $key == old('company_city_id', array_get($company, 'city_id')) ? 'selected' : '' }}>{{ $city }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Lokasi</label>
    <div class="col-sm-14">
        <div id="map" style="width: 100%; height: 300px;"></div>
        <input id="company_latitude" type="hidden" name="company_latitude" value="{{ old('company_latitude', array_get($company, 'company_latitude')) }}" required>
        <input id="company_longitude" type="hidden"  name="company_longitude" value="{{ old('company_longitude', array_get($company, 'company_longitude')) }}" required>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Alamat Penangkaran</label>
    <div class="col-sm-14">
        <input type="text" name="captivity_address" class="form-control" value="{{ old('captivity_address', array_get($company, 'captivity_address')) }}" required>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Total Pekerja</label>
    <div class="col-sm-14">
        <input type="number" name="labor_total" class="form-control" min="0" placeholder="0" value="{{ old('labor_total', array_get($company, 'labor_total')) }}" required>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Total Investasi</label>
    <div class="col-sm-14">
        <input id="investation_total" name="investation_total" type="text" class="form-control input-mask" data-mask="000.000.000.000.000" placeholder="eg: 000.000,00" maxlength="15" value="{{ old('investation_total', array_get($company, 'investation_total'))}}" required>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nomor NPWP Perusahaan</label>
    <div class="col-sm-14">
        <input id="npwp_number" type="text" class="form-control" name="npwp_number" value="{{ old('npwp_number', array_get($company, 'npwp_number')) }}" required>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Masa Berlaku Surat Izin Edar Berakhir</label>
    <div class="col-sm-14">
        <input type="text" class="form-control date-picker flatpickr-input active" placeholder="Pilih Tanggal" name="date_distribution" class="form-control" value="{{ old('date_distribution', array_get($company, 'date_distribution')) }}" required>
    </div>
</div>


<div class="form-group">
    <h5>D. Dokumen Perusahaan</h5>
</div>

@if(count($company)!=0)
    @foreach($company->companyDocuments as $key => $doc)
        <div id="file_download">
            <div class="form-group">
                <label class="control-label"><b>Dokumen {{$key+1}}</b></label>
                <div class="row">
                    <div class="col-sm-7">
                        {{$doc->pivot->document_name}}
                    </div>
                    <div class="col-sm-2">
                        <a href="{{$doc->pivot->download_url}}"><i class="zmdi zmdi-download zmdi-hc-fw"></i> Download</a>
                    </div>
                    <div class="col-sm-2">
                        <button onclick="deleteFile(this)" data-type-id="{{$doc->pivot->document_type_id}}" data-company-id="{{$doc->pivot->company_id}}" data-document-name="{{$doc->pivot->document_name}}" class="btn btn-danger">X</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
<div class="form-group">
    <label class="control-label">Dokumen</label>
    <div class="row">
        <div class="col-sm-10">
            <select id="document_type" class="form-control" name="document_type[]" {{$company==null ? 'required' : '' }}>
                <option value="">--Choose Document Type--</option>
                @foreach($document_type as $key=>$dt)
                    <option value="{{ $key }}" {{ $key == old('document_type') ? 'selected' : '' }}>{{ $dt }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-2">
            <button onclick="tambahForm(this)" class="btn btn-success">Tambah</button>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="control-label"></label>
    <div class="col-sm-14">
        <input id="company_file" type="file" class="form-control" name="company_file[]" accept="file_extension" {{$company==null ? 'required' : ''}}>
    </div>
</div>

<div id="form-dynamic">
</div>
@endcan

