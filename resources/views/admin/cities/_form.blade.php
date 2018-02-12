<div class="form-group">
    <label class="control-label">Kode Kabupaten/kota</label>
    <div class="col-sm-14">
            <input type="text" name="city_code" class="form-control" value="{{ old('city_code', array_get($city, 'city_code')) }}">
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nama Ibukota</label>
    <div class="col-sm-14">

            <input type="text" name="city_name" class="form-control" value="{{ old('city_name', array_get($city, 'city_name')) }}">

    </div>
</div>


<div class="form-group">
    <label class="control-label">Nama Kabupaten/Kota</label>
    <div class="col-sm-14">

            <input type="text" name="city_name_full" class="form-control" value="{{ old('city_name_full', array_get($city, 'city_name_full')) }}">

    </div>
</div>


<div class="form-group">
    <label class="control-label">Pilih Provinsi</label>
    <div class="row">
        <div class="col-sm-4">
            <select name="province_id" id="province_id" class="form-control select2" required>
                <option value="">--Pilih Provinsi--</option>
                @foreach($provinces as $key => $province)
                        <option value="{{ $key }}" {{ $key == old('province_id', array_get($city, 'province_id')) ? 'selected' : '' }}>{{ $province }}</option>
                @endforeach
            </select>
        </div>
      
    </div>
</div>
<br>
<br>
