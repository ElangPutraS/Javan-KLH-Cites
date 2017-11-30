
                        <div class="form-group">
                            <h5>A. Informasi Pelaku Usaha</h5>
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

                        <div class="form-group">
                            <label class="control-label">Masa Berlaku (Bulan)</label>
                            <div class="col-sm-14">
                                <input id="period" type="number" name="period" class="form-control" value="{{ old('trading_type_id', array_get($trade_permit , 'period')) }}">
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

                        <div class="form-group">
                            <h5>D. Daftar Spesimen</h5>
                            <p>Spesimen yang telah dipilih</p>
                        </div>
                        @foreach($trade_permit->tradeSpecies as $species)
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <b>{{$species->species_indonesia_name}} (<i>{{$species->species_scientific_name}}</i>)</b>
                                    </div>
                                    <div class="col-sm-4">
                                        Jenis Kelamin ({{$species->speciesSex->sex_name}})
                                    </div>
                                    <div class="col-sm-4">
                                        Jumlah {{$species->pivot->total_exported}}
                                    </div>
                                </div>
                            </div>
                        @endforeach