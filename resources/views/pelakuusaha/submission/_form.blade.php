
<div class="form-group">
    <h5>A. Informasi Pelaku Usaha</h5>
</div>
<div class="form-group">
    <label class="control-label">Nama Pelaku Usaha</label>
    <div class="col-sm-14">
        <input type="text" name="name" class="form-control" value="{{ old('name', array_get($user, 'name')) }}" readonly>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Nomor Identitas</label>
    <div class="col-sm-14">
        <input type="text" name="identity_number" class="form-control" value="{{ old('identity_number', array_get($user->userProfile->typeIdentify->first()->pivot, 'user_type_identify_number')) ?? '' }}" readonly>
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
        <div class="btn-group btn-group--colors" data-toggle="buttons" id="trading_type_id">
            @foreach($trading_types as $key=>$trading_type)
                <label class="btn bg-light-blue waves-effect {{ $key == old('trading_type_id', array_get($trade_permit, 'trading_type_id')) ? 'active' : '' }}"><input type="radio" id="trading_type_id{{$key}}" name="trading_type_id" value="{{$key}}" autocomplete="off" {{$key == old('trading_type_id', array_get($trade_permit, 'trading_type_id')) ? 'checked' : ''}} required></label> {{$trading_type}} &nbsp;&nbsp;&nbsp;
            @endforeach
        </div>
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
    <label class="control-label">Masa Berlaku</label>
    <div class="col-sm-14">
        6 Bulan
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
            <option value="">--Pilih Pelabuhan Tujuan--</option>
            @foreach($ports as $key => $port)
                <option value="{{ $key }}" {{ $key == old('port_destination', array_get($trade_permit, 'port_destination')) ? 'selected' : '' }}>{{ $port }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Penerima</label>
    <div class="col-sm-14">
        <input type="text" name="consignee" class="form-control" value="{{ old('consignee', array_get($trade_permit, 'consignee')) }}" required>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Jenis Appendix</label>
    <div class="col-sm-14">
        <div class="btn-group btn-group--colors" data-toggle="buttons" id="appendix_type">
            <label class="btn bg-green waves-effect"><input type="radio" id="appendix_type1" name="appendix_type" value="EA" autocomplete="off" required></label> SATS-LN Site (EA) &nbsp;&nbsp;&nbsp;&nbsp;
            <label class="btn bg-green waves-effect"><input type="radio" id="appendix_type2" name="appendix_type" value="EB" autocomplete="off" required></label> SATS-LN Non Site (EB)
        </div>
    </div>
</div>

<div class="form-group">
    <h5>C. Unggah Dokumen</h5>
    <small class="card-subtitle" style="color:red;">Maksimal Ukuran File 8 MB</small>
</div>
@foreach($document_types as $key => $document_type)
    <div class="form-group">
        <label class="control-label">{{$document_type}}</label>
        <div class="col-sm-14">
            <input type="hidden" class="form-control" name="document_type_id[]" value="{{$key}}" required>
            <input id="document_{{$key}}" type="file" class="form-control" name="document_trade_permit[]" accept="file_extension" {{$trade_permit==null ? 'required' : ''}}>
        </div>
    </div>
@endforeach
<div id="formDoc">

</div>

<div class="form-group">
    <h5>D. Informasi Spesimen</h5>
    <p>Silahkan Pilih Spesimen yang dibutuhkan!</p>
</div>
<div class="card">
    <div class="card-block">
        <div class="table-responsive">
            <table id="data-table" class="table table-bordered">
                <thead class="thead-default">
                <tr>
                    <th>No</th>
                    <th>Nama Ilmiah</th>
                    <th>Nama Lokal</th>
                    <th>Nama Umum</th>
                    <th>Sumber Appendix</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody id="tabelDinamis">

                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="form-group">
    <h5>E. Daftar Spesimen Yang Dipilih</h5>
    <p>Spesimen yang telah dipilih, wajib diisi!</p>
</div>

<div id="dynamicForm">

</div>


@push('body.script')
    <script type="text/javascript">
        var jumlahSpesimen=0;
        $(document).ready(function(){
            $('input[name="appendix_type"]').change(function(){
                var syarat='';
                var table=$('#data-table').DataTable();

                if (document.getElementById('appendix_type1').checked) {
                    syarat=document.getElementById('appendix_type1').value;
                }else if(document.getElementById('appendix_type2').checked){
                    syarat=document.getElementById('appendix_type2').value;
                }

                $.ajax({
                    type:'get',
                    url: window.baseUrl + '/getSpecies/'+syarat,
                    dataType: 'json',
                    success : function(data){
                        var element='';
                        console.log(data);
                        $('#dynamicForm').html('');
                        table.rows().remove().draw();
                        var no=0;

                        for(var i=0; i<data.length; i++){
                            no=no+1;
                            var scientific_name=data[i].species_scientific_name;
                            var indonesia_name=data[i].species_scientific_name;
                            var general_name=data[i].species_general_name;
                            var appendix_source='';
                            if(syarat=='EA'){
                                appendix_source=data[i]['appendix_source'].appendix_source_code;
                            }else{
                                appendix_source='Tidak Memiliki Appendix';
                            }

                            var quota='0';
                            var date=new Date();
                            var disabled='disabled';
                            var notif='<font color="red">Kuota 0, kuota belum ditentukan oleh admin!</font>';

                            for(var a=0; a<data[i].species_quota.length; a++){
                                if(data[i].species_quota[a].year == date.getFullYear()){
                                    quota=data[i].species_quota[a].quota_amount;
                                    if(data[i].species_quota[a].quota_amount==0){
                                        notif='<font color="red">Kuota tahun '+data[i].species_quota[a].year+' adalah '+data[i].species_quota[a].quota_amount+'</font>';
                                    }else{
                                        disabled='';
                                        notif='';
                                    }
                                }
                            }

                            var species_sex=data[i]['species_sex'].sex_name;
                            var aksi='<label class="custom-control custom-checkbox"><input type="checkbox" data-quota="'+quota+'" data-indonesia="'+indonesia_name+'" data-scientific="'+scientific_name+'" data-jk="'+species_sex+'" value="'+data[i].id+'" name="pilihan[]" onchange="test(this)" class="custom-control-input" '+disabled+'><span class="custom-control-indicator"></span>'+notif+'</label>';
                            table.row.add([no, scientific_name, indonesia_name, general_name, appendix_source, species_sex, aksi]).draw();
                        }
                    }
                });
            });

            $('#form-submission').submit(function(ev) {
                if(jumlahSpesimen==0){
                    alert('Silahkan pilih spesimen terlebih dahulu!');
                    ev.preventDefault();
                }else{
                    this.submit();
                }
            });

            $('input[name="trading_type_id"]').change(function(){
                if (document.getElementById('trading_type_id4').checked) {
                    $.ajax({
                        type:'get',
                        url: window.baseUrl + '/getDocumentType',
                        dataType: 'json',
                        success : function(data){
                            console.log(data);

                            var form='<div class="form-group"><label class="control-label">'+data['document_type_name']+'</label>';
                            form+='<div class="col-sm-14"><input type="hidden" class="form-control" name="document_type_id[]" value="'+data['id']+'" required>';
                            form+='<input id="document_'+data['id']+'" type="file" class="form-control" name="document_trade_permit[]" accept="file_extension" required>';
                            form+='</div></div>';

                            $('#formDoc').html(form);
                        }
                    });
                }else {
                    $('#formDoc').html('');
                }
            });
        });

        function test(a) {
            var form='';
            if(a.checked){
                var min=1;
                /*if(a.getAttribute('data-quota')==0){
                    min=0;
                }*/
                form+='<div class="form-group" id="formSpecies-'+a.getAttribute('value')+'"><label class="control-label">Jumlah</label>';
                form+='<p style="font-size: smaller"> Nama Spesimen : '+a.getAttribute('data-indonesia')+' (<i>'+a.getAttribute('data-scientific')+'</i>) | Jenis Kelamin : '+a.getAttribute('data-jk')+'</p>';
                form+='<div class="col-sm-14">';

                form+='<input type="hidden" name="species_id[]" class="form-control" value="'+a.getAttribute('value')+'">';
                form+='<input type="number" min="'+min+'" max="'+a.getAttribute('data-quota')+'" name="quantity[]" class="form-control" value="{{ old('quantity[]') ?? '0'}}" required>';
                form+='</div></div>';

                jumlahSpesimen=jumlahSpesimen+1;
                $('#dynamicForm').append(form);
            }else{
                $('#formSpecies-'+a.getAttribute('value')).remove();
                jumlahSpesimen=jumlahSpesimen-1;
            }
        }

        function cekSpesimen(a){

        }
    </script>
@endpush


