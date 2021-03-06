<div class="form-group">
    <label class="control-label">Komoditas Spesies</label>
    <div class="col-sm-14">
        <select name="species_comodity" id="species_comodity" class="form-control select2" onchange="cariSpesies(this)">
            <option value="">--Pilih Komoditas Spesies--</option>
            @foreach($categories as $category)
                @if($quota !== null)
                    <option value="{{ $category->id }}" {{ $category->id == old('species_comodity', array_get($company->companyQuota->first(), 'species_category_id')) ? 'selected' : '' }}>{{ $category->species_category_code.' - '.$category->species_category_name }}</option>
                @else
                    <option value="{{ $category->id }}" {{ $category->id == old('species_comodity') ? 'selected' : '' }}>{{ $category->species_category_code.' - '.$category->species_category_name }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Spesies</label>
            <select name="species_id" id="species_id" class="form-control select2" onchange="cekKuotaNasional(this)" required>
                <option value="">--Pilih Spesies--</option>
                @foreach($species as $spec)
                    <option value="{{ $spec->id }}" {{ $spec->id == old('species_id', array_get($quota, 'species_id')) ? 'selected' : '' }}><i>{{ $spec->species_scientific_name }}</i> - {{$spec->unit->unit_description}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label class="control-label">Tahun</label>
            <input type="text" id="year" name="year" placeholder="ex : 20xx" class="form-control" value="{{ old('year', array_get($quota, 'year')) }}" maxlength="4" oninput="cekKuotaNasional(this)" required>
        </div>
    </div>
</div>

<div class="kuotaYear">
    <div class="form-group">
        <label class="control-label">Kuota yang Tersedia</label>
        <div class="col-sm-14">
            <input type="text" id="quota_in" name="quota_in" class="form-control" value="{{ $quota_now ?? '0' }}" readonly>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Jumlah Kuota</label>
    <div class="col-sm-14">
        <input type="number" id="quota_amount" name="quota_amount" class="form-control" value="{{ old('quota_amount', array_get($quota, 'quota_amount')) }}" min="0" required>
    </div>
</div>

@if($quota)
    <div class="form-group">
        <label class="control-label">Jumlah Realisasi</label>
        <div class="col-sm-14">
            <input type="number" name="realization" class="form-control" min="0" max="{{$quota->quota_amount}}" value="{{ old('realization', array_get($quota, 'realization')) }}" required>
        </div>
    </div>
@endif

@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#form-quota').submit(function(ev) {
                //alert(parseInt($('#quota_in').val()) - parseInt($('#quota_amount').val()));
                if(parseInt($('#quota_in').val()) - parseInt($('#quota_amount').val()) >= 0 ){
                    this.submit();
                }else{
                    swal(
                        'Oops...',
                        'Kuota yang Anda masukkan tidak mencukupi, kuota perusahaan harus kurang dari sisa kuota nasional!',
                        'error'
                    );
                    ev.preventDefault();

                }
            });
        });
        function cariSpesies(a) {
            var comodity=$('#species_comodity').val();
            $.ajax({
                type: 'get',
                url: window.baseUrl +'/getSpeciesComodity/'+comodity,
                dataType: 'json',
                success : function (data) {
                    console.log(data);
                    var element='<option value="">--Pilih Spesies--</option>';
                    for(var i=0; i<data.length; i++){
                        element+='<option value="'+data[i].id+'">'+data[i].species_scientific_name+' '+data[i]['unit'].unit_description+'</option>';
                    }
                    $('#species_id').html(element);
                }
            });
        }
        
        function cekKuotaNasional(a) {
            var species_id = $('#species_id').val();
            var tahun = $('#year').val();

            if(species_id != '' && tahun != ''){
                $.ajax({
                    type: 'get',
                    url: window.baseUrl +'/getKuotaNasional/'+species_id+'/'+tahun,
                    dataType: 'json',
                    success : function (data) {
                        console.log(data);
                        $('#quota_in').val(data);
                    }
                });
            }
        }
    </script>
@endpush

