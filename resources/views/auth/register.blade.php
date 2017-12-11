@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row" style="margin-top: 10px; margin-bottom: 150px;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <br><font style="font-size: medium">1. Data Akun</font><br>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Kata Sandi</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required>

                                @if ($errors->has('password'))
                                    @if($errors->first('password') != "The password confirmation does not match.")
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Konfirmasi Kata Sandi</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                                @if ($errors->has('password'))
                                    @if($errors->first('password') == "The password confirmation does not match.")
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <br><font style="font-size: medium">1. Data Pelaku Usaha</font><br><br>

                        <div class="form-group{{ $errors->has('place_birth') ? ' has-error' : '' }}">
                            <label for="place_birth" class="col-md-4 control-label">Tempat Lahir</label>

                            <div class="col-md-6">
                                <input id="place_birth" type="text" class="form-control" name="place_birth" value="{{ old('place_birth') }}" required>

                                @if ($errors->has('place_birth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('place_birth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('date_birth') ? ' has-error' : '' }}">
                            <label for="date_birth" class="col-md-4 control-label">Tanggal Lahir</label>

                            <div class="col-md-6">
                                <input id="date_birth" placeholder="Pilih Tanggal" type="text" class="form-control" name="date_birth" value="{{ old('date_birth') }}" max="{{date('Y-m-d')}}" required>

                                @if ($errors->has('date_birth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_birth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-4 control-label">Nomor Telepon</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" required>

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nation') ? ' has-error' : '' }}">
                            <label for="nation" class="col-md-4 control-label">Negara</label>

                            <div class="col-md-6">
                                <select id="nation" class="form-control" name="nation" onchange="getState(this)" required>
                                    <option value="">--Pilih Negara--</option>
                                    @foreach($countries as $key => $country)
                                        <option value="{{ $key }}" {{ $key == old('nation') ? 'selected' : '' }}>{{ $country }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('nation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="state" class="col-md-4 control-label">Provinsi</label>

                            <div class="col-md-6">
                                <select id="state" class="form-control" name="state" onchange="getCity(this)" required>
                                    <option value="">--Pilih Provinsi--</option>
                                    @foreach($provinces as $key => $province)
                                        <option value="{{ $key }}" {{ $key == old('state') ? 'selected' : '' }}>{{ $province }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="state" class="col-md-4 control-label">Kota</label>

                            <div class="col-md-6">
                                <select id="city" class="form-control" name="city" required>
                                    <option value="">--Pilih Kota--</option>
                                    @foreach($cities as $key => $city)
                                        <option value="{{ $key }}" {{ $key == old('city') ? 'selected' : '' }}>{{ $city }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Alamat</label>

                            <div class="col-md-6">
                                <textarea id="address" class="form-control" name="address" required>{{ old('address') }}</textarea>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('identify_type') ? ' has-error' : '' }}">
                            <label for="state" class="col-md-4 control-label">Tipe Identitas</label>

                            <div class="col-md-6">
                                <select id="identify_type" class="form-control" name="identify_type" required>
                                    <option value="">--Pilih Tipe Identitas--</option>
                                    @foreach($user_type_identify as $key=>$idn)
                                        <option value="{{ $key }}" {{ $key == old('identify_type') ? 'selected' : '' }}>{{ $idn }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('identify_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('identify_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('person_identify') ? ' has-error' : '' }}">
                            <label for="person_identify" class="col-md-4 control-label">Nomor Identitas</label>

                            <div class="col-md-6">
                                <input id="person_identify" type="text" class="form-control" name="person_identify" value="{{ old('person_identify') }}" required>

                                @if ($errors->has('person_identify'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('person_identify') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <br><font style="font-size: medium">3. Data Perusahaan</font><br>

                        <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                            <label for="company_name" class="col-md-4 control-label">Nama Perusahaan</label>

                            <div class="col-md-6">
                                <input id="company_name" type="text" class="form-control" name="company_name" value="{{ old('company_name') }}" required>

                                @if ($errors->has('company_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_email') ? ' has-error' : '' }}">
                            <label for="company_email" class="col-md-4 control-label">Email Perusahaan</label>

                            <div class="col-md-6">
                                <input id="company_email" type="email" class="form-control" name="company_email" value="{{ old('company_email') }}" required>

                                @if ($errors->has('company_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_nation') ? ' has-error' : '' }}">
                            <label for="company_nation" class="col-md-4 control-label">Negara Perusahaan</label>

                            <div class="col-md-6">
                                <select id="company_nation" class="form-control" name="company_nation" onchange="getStateCompany(this)" required>
                                    <option value="">--Pilih Negara Perusahaan--</option>
                                    @foreach($countries as $key => $country)
                                        <option value="{{ $key }}" {{ $key == old('company_nation') ? 'selected' : '' }}>{{ $country }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('company_nation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_nation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_state') ? ' has-error' : '' }}">
                            <label for="company_state" class="col-md-4 control-label">Provinsi Perusahaan</label>

                            <div class="col-md-6">
                                <select id="company_state" class="form-control" name="company_state" onchange="getCityCompany(this)" required>
                                    <option value="">--Pilih Provinsi Perusahaan--</option>
                                    @foreach($provinces as $key => $province)
                                        <option value="{{ $key }}" {{ $key == old('company_state') ? 'selected' : '' }}>{{ $province }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('company_state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_city') ? ' has-error' : '' }}">
                            <label for="state" class="col-md-4 control-label">Kota Perusahaan</label>

                            <div class="col-md-6">
                                <select id="company_city" class="form-control" name="company_city" required>
                                    <option value="">--Pilih Kota Perusahaan--</option>
                                    @foreach($cities as $key => $city)
                                        <option value="{{ $key }}" {{ $key == old('company_city') ? 'selected' : '' }}>{{ $city }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('company_city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Alamat Perusahaan</label>

                            <div class="col-md-6">
                                <textarea id="company_address" class="form-control" name="company_address" required>{{ old('company_address') }}</textarea>
                                @if ($errors->has('company_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_fax') ? ' has-error' : '' }}">
                            <label for="company_fax" class="col-md-4 control-label">Fax Perusahaan</label>

                            <div class="col-md-6">
                                <input id="company_fax" type="text" class="form-control" name="company_fax" value="{{ old('company_fax') }}" required>

                                @if ($errors->has('company_fax'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_fax') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="long-lang" class="col-md-4 control-label">Lokasi Perusahaan</label>

                            <div class="col-md-6">
                                <div id="map" style="width: 100%; height: 300px;"></div>
                                <input id="company_latitude" type="hidden" name="company_latitude" value="{{ old('company_latitude') }}">
                                <input id="company_longitude" type="hidden"  name="company_longitude" value="{{ old('company_longitude') }}" required>
                            </div>
                        </div>
                        <br><center>--------------------------- Dokumen Perusahaan -----------------------------</center><br>
                        <center>
                            <button onclick="tambahForm(this)" class="btn btn-success">
                                Tambah
                            </button>
                        </center><br>

                        <div class="form-group{{ $errors->has('identify_type') ? ' has-error' : '' }}">
                            <label for="state" class="col-md-4 control-label">Document</label>

                            <div class="col-md-6">
                                <select id="document_type" class="form-control" name="document_type[]" required>
                                    <option value="">--Choose Document Type--</option>
                                    @foreach($document_type as $key=>$dt)
                                        <option value="{{ $key }}" {{ $key == old('document_type') ? 'selected' : '' }}>{{ $dt }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('document_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('document_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <input id="company_file" type="file" class="form-control" name="company_file[]" accept="file_extension" required>

                                @if ($errors->has('company_file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div id="form-dynamic"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<?php
    $doc_type='';
    foreach ($document_type as $key=>$dt){
        $doc_type.='<option value="'.$key.'">'.$dt.'</option>';
    }
?>
@push('body.script')
    <script>
        $(function() {
            $( "#date_birth" ).datepicker({
                format: "yyyy-mm-dd",
                todayHighlight: true,
                autoclose: true,
                endDate: new Date(),
            });
        });
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
    <script type="text/javascript">
        function initialize() {
            $('#company_latitude').val('-6.175392');
            $('#company_longitude').val('106.827153');
            var latlng = new google.maps.LatLng(-6.175392,106.827153);
            var map = new google.maps.Map(document.getElementById('map'), {
                center: latlng,
                zoom: 13
            });
            var marker = new google.maps.Marker({
                map: map,
                position: latlng,
                draggable: true,
                anchorPoint: new google.maps.Point(0, -29)
            });
            var infowindow = new google.maps.InfoWindow();
            google.maps.event.addListener(marker, 'click', function() {
                var iwContent = '<div id="iw_container">' +
                    '<div class="iw_title"><b>My Company Location</b></div></div>';
                // including content to the infowindow
                infowindow.setContent(iwContent);
                // opening the infowindow in the current map and at the current marker location
                infowindow.open(map, marker);
            });
            google.maps.event.addListener(marker, 'dragend', function(evt){
                //document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
                $('#company_latitude').val(evt.latLng.lat().toFixed(5));
                $('#company_longitude').val(evt.latLng.lng().toFixed(5));
                //alert($('#company_latitude').val()+' '+$('#company_longitude').val());
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);

        function getState(a) {
            var country=$('#nation').val();
            $.ajax({
                type: 'get',
                url: window.baseUrl +'/getProvince/'+country,
                dataType: 'json',
                success : function (data) {
                    //alert(data);
                    var element='<option value="">--Pilih Provinsi--</option>';
                    for(var i=0; i<data.length; i++){
                        element+='<option value="'+data[i].id+'">'+data[i].province_name+'</option>';
                    }
                    $('#state').html(element);
                }
            });
        }

        function getCity(a) {
            var province=$('#state').val();
            $.ajax({
                type: 'get',
                url: window.baseUrl +'/getCity/'+province,
                dataType: 'json',
                success : function (data) {
                    var element='<option value="">--Pilih Kota--</option>';
                    for(var i=0; i<data.length; i++){
                        element+='<option value="'+data[i].id+'">'+data[i].city_name_full+'</option>';
                    }
                    $('#city').html(element);
                }
            });
        }

        function getStateCompany(a) {
            var country=$('#company_nation').val();
            $.ajax({
                type: 'get',
                url: window.baseUrl +'/getProvince/'+country,
                dataType: 'json',
                success : function (data) {
                    //alert(data);
                    var element='<option value="">--Pilih Provinsi Perusahaan-</option>';
                    for(var i=0; i<data.length; i++){
                        element+='<option value="'+data[i].id+'">'+data[i].province_name+'</option>';
                    }
                    $('#company_state').html(element);
                }
            });
        }

        function getCityCompany(a) {
            var city=$('#company_state').val();
            $.ajax({
                type: 'get',
                url: window.baseUrl +'/getCity/'+city,
                dataType: 'json',
                success : function (data) {
                    var element='<option value="">--Pilih Kota Perusahaan--</option>';
                    for(var i=0; i<data.length; i++){
                        element+='<option value="'+data[i].id+'">'+data[i].city_name_full+'</option>';
                    }
                    $('#company_city').html(element);
                }
            });
        }

        function tambahForm(a) {
            var form='<div id="dynamic"><div class="form-group">';
            form+='<label for="state" class="col-md-4 control-label">Dokumen</label>';
            form+='<div class="col-md-6"><select id="document_type" class="form-control" name="document_type[]" required><option value="">--Pilih Tipe Dokumen--</option>';
            form+='<?=$doc_type?>';
            form+='</select></div></div>';
            form+='<div class="form-group"><label class="col-md-4 control-label"></label><div class="col-md-5"><input id="company_file" type="file" class="form-control" name="company_file[]" accept="file_extension" required>';
            form+='</div><div class="col-md-1"><button onclick="hapusForm(this)" class="btn btn-danger">X</button></div></div></div>';
            $('#form-dynamic').append(form);
            //alert(form);
        }

        function hapusForm(a) {
            //alert('cek');
            a.closest('#dynamic').remove();
        }
    </script>
@endpush

