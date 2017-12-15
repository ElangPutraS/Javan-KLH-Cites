<div class="form-group">
    <label class="control-label">Nama</label>
    <div class="col-sm-14">
        @if ($port)
        <input class="form-control" type="text" name="name" id="name" value="{{ old('name', array_get($port, 'name')) }}" placeholder="Persentase Nilai Spesies">
        @else
        <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Persentase Nilai Spesies">
        @endif
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nilai</label>
    <div class="col-sm-14">
        @if ($port)
        <input class="form-control" type="text" name="value" id="value" value="{{ old('value', array_get($port, 'value')) }}" placeholder="100">
        @else
        <input class="form-control" type="text" name="value" id="value" value="{{ old('value') }}" placeholder="100">
        @endif
    </div>
</div>

<div id="form-dynamic">
</div>
