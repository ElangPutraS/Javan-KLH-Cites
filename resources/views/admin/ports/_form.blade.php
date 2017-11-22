<div class="form-group">
    <h3>Data Pelabuhan</h3>
</div>
<div class="form-group">
    <label class="control-label">Kode</label>
    <div class="col-sm-14">
        @if ($port)
        <input class="form-control" type="text" name="port_code" id="port_code" value="{{ old('port_code') }}">
        @else
        <input class="form-control" type="text" name="port_code" id="port_code" value="{{ old('port_code', array_get($port, 'port_code')) }}">
        @endif
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nama</label>
    <div class="col-sm-14">
        @if ($port)
        <input class="form-control" type="text" name="port_name" id="port_name" value="{{ old('port_name') }}">
        @else
        <input class="form-control" type="text" name="port_name" id="port_name" value="{{ old('port_name', array_get($port, 'port_name')) }}">
        @endif
    </div>
</div>

<div id="form-dynamic">
</div>
