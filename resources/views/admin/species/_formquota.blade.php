<div class="form-group">
    <label class="control-label">Tahun</label>
    <div class="col-sm-14">
        <input type="text" name="year" class="form-control" value="{{ old('year', array_get($quota, 'year')) }}" maxlength="4" required>
    </div>
</div>

@if($quota == null)

    <div class="form-group">
        <label class="control-label">Jumlah Kuota</label>
        <div class="col-sm-14">
            <input type="number" name="quota_amount" class="form-control" value="{{ old('quota_amount', array_get($quota, 'quota_amount')) }}" min="0" required>
        </div>
    </div>

@else
    <div class="form-group">
        <label class="control-label">Jumlah Kuota Saat Ini</label>
        <div class="col-sm-14">
            <input type="number" name="quota_now" id="quota_now" class="form-control" value="{{ old('quota_now', array_get($quota, 'quota_amount')) }}" min="0" readonly>
        </div>
    </div>

    @if(Request::segment(4) == 'plus')
        <div class="form-group">
            <label class="control-label">Kuota Tambahan</label>
            <div class="col-sm-14">
                    <input type="number" name="quota_plus" id="quota_plus" oninput="plusKuota(this)" class="form-control" value="{{ old('quota_plus') }}" placeholder="ex : 0" value="0" min="0" required>
            </div>
        </div>
    @elseif(Request::segment(4) == 'minus')
        <div class="form-group">
            <label class="control-label">Kurangi Kuota</label>
            <div class="col-sm-14">
                <input type="number" name="quota_min" id="quota_min" oninput="minusKuota(this)" class="form-control" value="{{ old('quota_min') }}" placeholder="ex : 0" value="0" min="0" required>
            </div>
        </div>
    @endif

    <div class="form-group">
        <label class="control-label">Jumlah Kuota Akhir</label>
        <div class="col-sm-14">
            <input type="number" name="quota_amount" id="quota_amount" class="form-control" value="{{ old('quota_amount', array_get($quota, 'quota_amount')) }}" min="0" readonly>
        </div>
    </div>
@endif
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        function plusKuota(a) {
            var kuota_skg=$('#quota_now').val();
            var kuota_plus=$('#quota_plus').val();

            if(kuota_plus == ''){
                kuota_plus=0;
            }

            var kuota = parseInt(kuota_skg) + parseInt(kuota_plus);

            $('#quota_amount').val(kuota);
        }

        function minusKuota(a) {
            var kuota_skg=$('#quota_now').val();
            var kuota_minus=$('#quota_min').val();

            if(kuota_minus == ''){
                kuota_minus=0;
            }

            var kuota = parseInt(kuota_skg) - parseInt(kuota_minus);

            $('#quota_amount').val(kuota);

            if(kuota < 0){
                swal(
                    'Oops...',
                    'Pengurangan kuota melebihi dari jumlah kuota saat ini !',
                    'error'
                )
                $('#quota_amount').val(kuota_skg);
                $('#quota_min').val('');

            }

        }
    </script>
@endpush

