<div class="form-group">
    <h5>Melakukan Perpanjangan ? </h5>
    <div class="col-sm-14">
        <div class="btn-group btn-group--colors" data-toggle="buttons" id="is_renewal">
            <label class="btn bg-light-blue waves-effect"><input type="radio" id="is_renewal1" name="is_renewal" value="1" autocomplete="off" required></label>Ya &nbsp;&nbsp;&nbsp;
            <label class="btn bg-red waves-effect"><input type="radio" id="is_renewal2" name="is_renewal" value="0" autocomplete="off" required></label>Tidak
        </div>
    </div>
</div>

<div class="form-group">

</div>
<div class="form-group">
    <label class="control-label">Nama Pelaku Usaha</label>
    <div class="col-sm-14">
        <input type="text" name="name" class="form-control" value="{{ old('name', array_get($user , 'name')) }}" readonly>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nomor Identitas</label>
    <div class="col-sm-14">
        <input type="text" name="identity_number" class="form-control" value="{{ old('identity_number', array_get($user->userProfile->typeIdentify->first()->pivot, 'user_type_identify_number')) }}" readonly>
    </div>
</div>


<div class="form-group">
    <label class="control-label">Nama Usaha</label>
    <div class="col-sm-14">
        <input type="text" name="company_name" class="form-control" value="{{ old('identity_number', array_get($user->userProfile->company, 'company_name')) }}" readonly>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Alamat Usaha</label>
    <div class="col-sm-14">
        <input type="text" name="company_address" class="form-control" value="{{ old('company_address', array_get($user->userProfile->company, 'company_address')) }}" readonly>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nomor Faksimile</label>
    <div class="col-sm-14">
        <input type="text" name="company_fax" class="form-control" value="{{ old('company_fax', array_get($user->userProfile->company, 'company_fax')) }}" readonly>
    </div>
</div>

<div class="form-group">
    <h5>B. Informasi Permohonan</h5>
</div>
<div class="form-group">
    <label class="control-label">Jenis Perdagangan</label>
    <div class="col-sm-14">
        <input type="text" name="trading_type_id" class="form-control" value="{{ old('trading_type_id', array_get($trade_permit->tradingType, 'trading_type_name')) }}" readonly>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Jenis Kegiatan</label>
    <div class="col-sm-14">
        <select name="purpose_type_id" id="purpose_type_id" class="form-control select2" required>
            <option value="">--Pilih Jenis Kegiatan--</option>
            @foreach($purpose_types as $key => $purpose_type)
                <option value="{{ $key }}" {{ $key == old('purpose_type_id', array_get($trade_permit, 'purpose_type_id')) ? 'selected' : '' }}>{{ $purpose_type }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group" id="showPeriod">
    <label class="control-label">Masa Berlaku (Bulan)</label>
    <div class="col-sm-14">
        @if($trade_permit->period == 6)
            <input id="period" type="number" name="period" min="1" max="6" class="form-control" value="{{ old('trading_type_id', array_get($trade_permit , 'period')) }}" readonly>
        @else
            <div class="btn-group btn-group--colors" data-toggle="buttons">
                <label class="btn bg-red waves-effect {{ '1' == old('period', array_get($trade_permit, 'period')) ? 'active' : '' }}"><input type="radio" id="period1" name="period" value="1" autocomplete="off" {{ '1' == old('period', array_get($trade_permit, 'period')) ? 'checked' : '' }} required></label> 1 Bulan &nbsp;&nbsp;&nbsp;
                <label class="btn bg-red waves-effect {{ '2' == old('period', array_get($trade_permit, 'period')) ? 'active' : '' }}"><input type="radio" id="period2" name="period" value="2" autocomplete="off" {{ '2' == old('period', array_get($trade_permit, 'period')) ? 'checked' : '' }} required></label> 2 Bulan &nbsp;&nbsp;&nbsp;
                <label class="btn bg-red waves-effect {{ '3' == old('period', array_get($trade_permit, 'period')) ? 'active' : '' }}"><input type="radio" id="period3" name="period" value="3" autocomplete="off" {{ '3' == old('period', array_get($trade_permit, 'period')) ? 'checked' : '' }} required></label> 3 Bulan &nbsp;&nbsp;&nbsp;
            </div>
        @endif

    </div>
</div>

<div class="form-group">
    <label class="control-label">Pelabuhan Ekspor</label>
    <div class="col-sm-14">
        <select name="port_exportation" id="port_exportation" class="form-control select2" required>
            <option value="">--Pilih Pelabuhan Ekspor--</option>
            @foreach($ports as $key => $port)
                <option value="{{ $key }}" {{ $key == old('port_exportation', array_get($trade_permit, 'port_exportation')) ? 'selected' : '' }}>{{ $port }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Pelabuhan Tujuan</label>
    <div class="col-sm-14">
        <select name="port_destination" id="port_destination" class="form-control select2" required>
            <option value="">--Pilih Pelabuhan Ekspor--</option>
            @foreach($ports as $key => $port)
                <option value="{{ $key }}" {{ $key == old('port_destination', array_get($trade_permit, 'port_destination')) ? 'selected' : '' }}>{{ $port }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Penerima</label>
    <div class="col-sm-14">
        <input id="consignee" type="text" name="consignee" class="form-control" value="{{ old('consignee', array_get($trade_permit, 'consignee')) }}">
    </div>
</div>

<div class="form-group">
    <label class="control-label">Jenis Appendix</label>
    <div class="col-sm-14">
        <input type="text" name="appendix_type" class="form-control" value="@if($trade_permit->appendix_type == 'EA') {{'SATS-LN Site (EA)'}} @else {{'SATS-LN Non Site (EB)'}} @endif"readonly>
    </div>
</div>

<div class="form-group">
    <h5>C. Dokumen Unggahan</h5>
</div>
<div class="form-group">
    <label class="control-label">Re-upload SATS-LN</label>
    <div class="col-sm-14">
        <input type="hidden" class="form-control" name="document_type_id" value="9" required>
        <input type="file" class="form-control" name="document_trade_permit" accept="file_extension" required>
    </div>
</div>

<div class="card">
    <div class="card-block">
        <div class="table-responsive">
            <div class="form-group">
                <h5>D. Daftar Spesimen</h5>
                <p>Spesimen yang telah dipilih</p>
            </div>
            <table id="data-table" class="table table-bordered">
                <thead class="thead-default">
                <tr>
                    <th>No</th>
                    <th>Nama Species</th>
                    <th>Jenis Kelamin</th>
                    <th>Jumlah Ekspor</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1;?>
                @foreach($trade_permit->tradeSpecies as $species)
                    <tr>
                        <td><?=$no++?></td>
                        <td>{{$species->species_indonesia_name}} (<i>{{$species->species_scientific_name}}</i>)</td>
                        <td>{{$species->speciesSex->sex_name}}</td>
                        <td>{{$species->pivot->total_exported}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

