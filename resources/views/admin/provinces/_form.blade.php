<div class="form-group">
    <h3>Data Provinsi</h3>
</div>

<div class="form-group">
    <label class="control-label">Pilih negara</label>
        <div class="col-sm-4">
            <select name="country_id" id="country_id" class="form-control select2" onchange="getState(this)">
                <option value="">--Pilih Negara--</option>
                @foreach($countries as $key => $country)
                	<option value="{{ $key }}" {{ $key == old('country_id', array_get($province, 'country_id')) ? 'selected' : '' }}>{{ $country }}</option>
                
                @endforeach
            </select>
        </div>
</div>


<div class="form-group">
    <label class="control-label">Kode Provinsi</label>
    <div class="col-sm-14">
            <input type="text" name="province_code" class="form-control" value="{{ old('province_code', array_get($province, 'province_code')) }}">
    </div>
</div>


<div class="form-group">
    <label class="control-label">Nama Provinsi</label>
    <div class="col-sm-14">

            <input type="text" name="province_name" class="form-control" value="{{ old('province_name', array_get($province, 'province_name')) }}">

    </div>
</div>


