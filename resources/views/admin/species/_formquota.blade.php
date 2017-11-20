<div class="form-group">
    <h3>Form Quota</h3>
    <small class="card-subtitle">Species {{$species->species_indonesia_name}}</small>
</div>
<div class="form-group">
    <label class="control-label">Tahun</label>
    <div class="col-sm-14">
        <input type="text" name="year" class="form-control" value="{{ old('year', array_get($quota, 'year')) }}" required>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Jumlah Quota</label>
    <div class="col-sm-14">
        <input type="number" name="quota_amount" class="form-control" value="{{ old('quota_amount', array_get($quota, 'quota_amount')) }}" required>
    </div>
</div>

