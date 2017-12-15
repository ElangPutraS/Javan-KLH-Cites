
@if($trade_permit->period !== 6)
    <div class="form-group">
    <h5>Melakukan Perpanjangan ? </h5>
    <div class="col-sm-14">
        <div class="btn-group btn-group--colors" data-toggle="buttons" id="is_renewal">
            <label class="btn bg-light-blue waves-effect"><input type="radio" id="is_renewal1" name="is_renewal" value="1" autocomplete="off" required></label>Ya &nbsp;&nbsp;&nbsp;
            <label class="btn bg-red waves-effect"><input type="radio" id="is_renewal2" name="is_renewal" value="0" autocomplete="off" required></label>Tidak
        </div>
    </div>
</div>
@endif


<div class="form-group">
    <h5>A. Informasi Pelaku Usaha</h5>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Nama Pemilik Usaha</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', array_get($user->company, 'owner_name')) }}" readonly>
        </div>
        <div class="col-sm-6">
            <label class="control-label">Nama Perusahaan</label>
            <input type="text" name="company_name" class="form-control" value="{{ old('identity_number', array_get($user->userProfile->company, 'company_name')) }}" readonly>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Nomor NPWP Pemilik Usaha</label>
            <input type="text" name="npwp_number_user" class="form-control" value="{{ old('npwp_number_user', array_get($user->userProfile, 'npwp_number')) }}" readonly>
        </div>
        <div class="col-sm-6">
            <label class="control-label">Nomor NPWP Perusahaan</label>
            <input type="text" name="npwp_number" class="form-control" value="{{ old('npwp_number', array_get($user->company, 'npwp_number')) }}" readonly>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Alamat Usaha</label>
            <input type="text" name="company_address" class="form-control" value="{{ old('company_address', array_get($user->company, 'company_address')) }}" readonly>
        </div>
        <div class="col-sm-6">
            <label class="control-label">Alamat Penangkaran</label>
            <input type="text" name="captivity_address" class="form-control" value="{{ old('captivity_address', array_get($user->company, 'captivity_address')) }}" readonly>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Masa Berlaku Surat Izin Edar</label>
            <input type="text" name="date_distribution" class="form-control" value="{{ Carbon\Carbon::parse($user->company->date_distribution)->toFormattedDateString() }}" readonly>
        </div>
        <div class="col-sm-6">
            <label class="control-label">Nomor Kontak</label>
            <input type="text" name="mobile" class="form-control" value="{{ old('mobile', array_get($user->userProfile, 'mobile')) }}" readonly>
        </div>
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

<div class="form-group">
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Penerima</label>
            <input type="text" name="consignee" class="form-control" value="{{ old('consignee', array_get($trade_permit, 'consignee')) }}" required>
        </div>
        <div class="col-sm-6">
            <label class="control-label">Alamat Penerima</label>
            <textarea name="consignee_address" class="form-control" value="{{ old('consignee_address', array_get($trade_permit, 'consignee_address')) }}" required></textarea>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Negara Tujuan</label>
            <select name="port_exportation" id="country_destination" class="form-control select2" required>
                <option value="">--Pilih Negara Tujuan--</option>
                @foreach($ports as $key => $port)
                    <option value="{{ $key }}" {{ $key == old('country_destination', array_get($trade_permit, 'country_destination'), , '1') ? 'selected' : '' }}>{{ $port }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label class="control-label">Pelabuhan Tujuan</label>
            <select name="port_destination" id="port_destination" class="form-control select2" required>
                <option value="">--Pilih Pelabuhan Tujuan--</option>
                @foreach($ports as $key => $port)
                    <option value="{{ $key }}" {{ $key == old('port_destination', array_get($trade_permit, 'port_destination')) ? 'selected' : '' }}>{{ $port }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Negara Ekspor</label>
            <select name="port_exportation" id="country_exportation" class="form-control select2" required>
                <option value="">--Pilih Negara Ekspor--</option>
                @foreach($ports as $key => $port)
                    <option value="{{ $key }}" {{ $key == old('country_exportation', array_get($trade_permit, 'country_exportation'), '1') ? 'selected' : '' }}>{{ $port }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label class="control-label">Pelabuhan Ekspor</label>
            <select name="port_exportation" id="port_exportation" class="form-control select2" required>
                <option value="">--Pilih Pelabuhan Ekspor--</option>
                @foreach($ports as $key => $port)
                    <option value="{{ $key }}" {{ $key == old('port_exportation', array_get($trade_permit, 'port_exportation')) ? 'selected' : '' }}>{{ $port }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Jenis Appendix</label>
    <div class="col-sm-14">
        <input type="text" name="appendix_type" class="form-control" value="@if($trade_permit->appendix_type == 'EA') {{'SATS-LN Site (EA)'}} @else {{'SATS-LN Non Site (EB)'}} @endif"readonly>
    </div>
</div>

@if($trade_permit->status_code === 3)
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
@endif


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
                    <th>Satuan</th>
                    <th>Jumlah Ekspor</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1;?>
                @foreach($trade_permit->tradeSpecies as $species)
                    <tr>
                        <td><?=$no++?></td>
                        <td>{{$species->species_indonesia_name}} (<i>{{$species->species_scientific_name}}</i>)</td>
                        <td>{{$species->unit->unit_description}}</td>
                        <td>{{$species->pivot->total_exported}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

