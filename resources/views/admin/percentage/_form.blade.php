<div class="form-group">
    <label class="control-label">Nama</label>
    <div class="col-sm-14">
        @if ($percentage)
        <input class="form-control" type="text" name="name" id="name" value="{{ old('name', array_get($percentage, 'name')) }}" placeholder="Persentase Nilai Spesies" minlength="1" maxlength="64" required>
        @else
        <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Persentase Nilai Spesies" minlength="1" maxlength="64" required>
        @endif
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nilai</label>
    <div class="col-sm-14">
        @if ($percentage)
        <input class="form-control" type="number" name="value" id="value" value="{{ old('value', array_get($percentage, 'value')) }}" placeholder="100" min="1" max="999999999999999" required>
        @else
        <input class="form-control" type="number" name="value" id="value" value="{{ old('value') }}" placeholder="100" min="1" max="999999999999999" required>
        @endif
    </div>
</div>

<div id="form-dynamic">
</div>
