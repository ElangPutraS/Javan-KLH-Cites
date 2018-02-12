<input type="hidden" name="company_id" id="company_id"  class="form-control" value="{{ old('company_id', array_get($user->company, 'id')) }}" readonly>
<div class="form-group">
    <h5>A. Informasi Perusahaan</h5>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Nama Pemilik Usaha</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', array_get($user->company, 'owner_name')) }}" readonly>
        </div>
        <div class="col-sm-6">
            <label class="control-label">Nama Perusahaan</label>
            <input type="text" name="company_name" class="form-control" value="{{ old('identity_number', array_get($user->company, 'company_name')) }}" readonly>
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
        <div class="btn-group btn-group--colors" data-toggle="buttons" id="trading_type_id">
            @foreach($trading_types as $key=>$trading_type)
                <label class="btn bg-light-blue waves-effect"><input type="radio" id="trading_type_id{{$key}}" name="trading_type_id" value="{{$key}}" autocomplete="off" required></label> {{$trading_type}} &nbsp;&nbsp;&nbsp;
            @endforeach
        </div>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Komoditas</label>
    <div class="col-sm-14">
        <select name="category_id" id="category_id" class="form-control select2" onchange="cekSpesimen(this)" required>
            <option value="">--Pilih Komoditas--</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == old('category_id', array_get($trade_permit, 'category_id')) ? 'selected' : '' }}>{{ $category->species_category_code.' - '.$category->species_category_name }}</option>
            @endforeach
        </select>
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
    <label class="control-label">Sumber Spesies</label>
    <div class="col-sm-14">
        <select name="source_id" id="source_id" class="form-control select2" onchange="cekSpesimen(this)" required>
            <option value="">--Pilih Sumber Spesies--</option>
            @foreach($sources as $source)
                <option value="{{ $source->id }}" {{ $key == old('source_id', array_get($trade_permit, 'source_id')) ? 'selected' : '' }}>{{ $source->source_code.' - '.$source->source_description }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Maksud Transaksi</label>
    <div class="col-sm-14">
        <select name="purpose_type_id" id="purpose_type_id" class="form-control select2" required>
            <option value="">--Pilih Maksud Transaksi--</option>
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
            <textarea type="text" name="consignee_address" class="form-control" required>{{ old('consignee_address', array_get($trade_permit, 'consignee_address')) }}</textarea>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Negara Tujuan</label>
            <select name="country_destination" id="country_destination" class="form-control select2" required>
                <option value="">--Pilih Negara Tujuan--</option>
                @foreach($countries as $key => $country)
                    <option value="{{ $key }}" {{ $key == old('country_destination', array_get($trade_permit, 'country_destination')) ? 'selected' : '' }}>{{ $country }}</option>
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
            <select name="country_exportation" id="country_exportation" class="form-control select2" required>
                <option value="">--Pilih Negara Ekspor--</option>
                @foreach($countries as $key => $country)
                    <option value="{{ $key }}" {{ $key == old('country_exportation', array_get($trade_permit, 'country_exportation')) ? 'selected' : '' }}>{{ $country }}</option>
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
    <h5>C. Unggah Dokumen</h5>
    <small class="card-subtitle" style="color:red;">Maksimal Ukuran File 8 MB</small>
</div>
@foreach($document_types as $key => $document_type)
    <div class="form-group">
        <label class="control-label">{{$document_type}}</label>
        <div class="col-sm-14">
            <input type="hidden" class="form-control" name="document_type_id[]" value="{{$key}}" required>
            <input id="document_{{$key}}" type="file" class="form-control" name="document_trade_permit[]" accept="file_extension" {{$trade_permit == null  ? 'required' : ''}}>
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
                    <th>Satuan</th>
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
                cekSpesimen(this);
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
                var trading_type_id = '';
                if (document.getElementById('trading_type_id1').checked) {
                    trading_type_id = document.getElementById('trading_type_id1').value;
                }else if(document.getElementById('trading_type_id2').checked){
                    trading_type_id = document.getElementById('trading_type_id2').value;
                }else if(document.getElementById('trading_type_id3').checked){
                    trading_type_id = document.getElementById('trading_type_id3').value;
                }else if(document.getElementById('trading_type_id4').checked){
                    trading_type_id = document.getElementById('trading_type_id4').value;
                }

                $('#formDoc').html('');
                if(trading_type_id != ''){
                    $.ajax({
                        type:'get',
                        url: window.baseUrl + '/getDocumentType/'+trading_type_id,
                        dataType: 'json',
                        success : function(data){
                            //console.log(data);
                            var form='';
                            $('#formDoc').html(form);

                            for(var i=0; i<data.length; i++){
                                var required = '';
                                if(data[i]['is_permit'] != '5'){
                                    required = 'required';
                                }
                                form+='<div class="form-group"><label class="control-label">'+data[i]['document_type_name']+'</label>';
                                form+='<div class="col-sm-14"><input type="hidden" class="form-control" name="document_type_id[]" value="'+data[i]['id']+'" required>';
                                form+='<input id="document_'+data[i]['id']+'" type="file" class="form-control" name="document_trade_permit[]" accept="file_extension" '+required+'>';
                                form+='</div></div>';
                                
                            }
                            $('#formDoc').html(form);
                        }
                    });
                }else{
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
                form+='<div class="form-group" id="formSpecies-'+a.getAttribute('value')+'"><label class="control-label"><b>Nama Spesimen : '+a.getAttribute('data-indonesia')+' (<i>'+a.getAttribute('data-scientific')+'</i>) | Satuan : '+a.getAttribute('data-unit')+'</b></label>';
                form+='<p style="font-size: smaller">Jumlah</p>';
                form+='<div class="col-sm-14">';

                form+='<input type="hidden" name="species_id[]" class="form-control" value="'+a.getAttribute('value')+'">';
                form+='<input type="number" min="'+min+'" max="'+a.getAttribute('data-quota')+'" name="quantity[]" class="form-control" value="{{ old('quantity[]') ?? '0'}}" required></div>';
                form+='<p style="font-size: smaller">Deskripsi Spesies</p>';
                form+='<div class="col-sm-14"><textarea class="form-control" id="description" name="description[]"></textarea></div>';
                form+='</div>';

                jumlahSpesimen=jumlahSpesimen+1;
                $('#dynamicForm').append(form);
            }else{
                $('#formSpecies-'+a.getAttribute('value')).remove();
                jumlahSpesimen=jumlahSpesimen-1;
            }
        }

        function cekSpesimen(a){
            var s1='';
            var table=$('#data-table').DataTable();

            if (document.getElementById('appendix_type1').checked) {
                s1=document.getElementById('appendix_type1').value;
            }else if(document.getElementById('appendix_type2').checked){
                s1=document.getElementById('appendix_type2').value;
            }

            var s2=$('#category_id').val();
            var s3=$('#source_id').val();

            if(s1 != '' && s2 != '' && s3 != ''){
                $.ajax({
                    type:'get',
                    url: window.baseUrl + '/getSpecies/'+s1+'/'+s2+'/'+s3,
                    dataType: 'json',
                    success : function(data){
                        var element='';
                        //console.log(data);
                        $('#dynamicForm').html('');
                        table.rows().remove().draw();
                        var no=0;

                        for(var i=0; i<data.length; i++){
                            no=no+1;
                            var scientific_name=data[i].species_scientific_name;
                            var indonesia_name=data[i].species_scientific_name;
                            var general_name=data[i].species_general_name;
                            var unit=data[i].unit.unit_description;
                            var appendix_source='';
                            if(s1=='EA'){
                                appendix_source=data[i]['appendix_source'].appendix_source_code;
                            }else{
                                appendix_source='Tidak Memiliki Appendix';
                            }

                            var quota='0';
                            var date=new Date();
                            var disabled='disabled';
                            var notif='<font color="red">Kuota 0, kuota belum ditentukan oleh admin!</font>';

                            for(var a=0; a<data[i].company_quota.length; a++){
                                if(data[i].company_quota[a].pivot.year == date.getFullYear() && data[i].company_quota[a].pivot.company_id == $('#company_id').val()){
                                    quota = data[i].company_quota[a].pivot.quota_amount - data[i].company_quota[a].pivot.realization;
                                    //console.log(quota);
                                    if(quota<=0){
                                        notif='<font color="red">Kuota perusahaan tahun ini adalah 0 / sudah habis.</font>';
                                    }else{
                                        disabled='';
                                        notif='';
                                    }
                                }
                            }

                            var aksi='<label class="custom-control custom-checkbox"><input type="checkbox" data-quota="'+quota+'" data-indonesia="'+indonesia_name+'" data-scientific="'+scientific_name+'" data-unit="'+unit+'" value="'+data[i].id+'" name="pilihan[]" onchange="test(this)" class="custom-control-input" '+disabled+'><span class="custom-control-indicator"></span>'+notif+'</label>';
                            table.row.add([no, scientific_name, indonesia_name, general_name, appendix_source, unit, aksi]).draw();
                        }
                    }
                });
            }
        }
    </script>
@endpush


