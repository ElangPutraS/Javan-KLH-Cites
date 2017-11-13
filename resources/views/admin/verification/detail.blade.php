@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner content__inner--sm">
            <header class="content__title">
                <h1>{{$company->userProfile->user->name}}</h1>
                <small><i class="zmdi zmdi-city-alt zmdi-hc-fw"></i> {{$company->company_name}}</small>
                @if($company->company_status==1)
                    <small>Status Perusahaan : <span class="badge badge-success">Verifikasi Disetujui</span></small>
                @elseif($company->company_status==2)
                    <small>Status Perusahaan : <span class="badge badge-danger">Verifikasi Ditolak</span></small>
                    <small>Alasan Penolakan  : {{$company->reject_reason}}</small>
                @endif
            </header>

            <div class="card profile">
                <div class="profile__info">
                    <h4 class="card-block__title mb-4">Data Pelaku Usaha</h4>

                    <ul class="icon-list">
                        <li><i class="zmdi zmdi-account zmdi-hc-fw"></i> {{$company->userProfile->user->name}}</li>
                        <li><i class="zmdi zmdi-email"></i> {{$company->userProfile->user->email}}</li>
                        <li><i class="zmdi zmdi-phone"></i> {{$company->userProfile->mobile}}</li>
                        <li><i class="zmdi zmdi-cake zmdi-hc-fw"></i> {{$company->userProfile->place_of_birth}}, {{Carbon\Carbon::parse($company->userProfile->date_of_birth)->format('d-m-Y')}}</li>
                        <li><i class="zmdi zmdi-pin zmdi-hc-fw"></i> {{$company->userProfile->address}},  {{$company->userProfile->city->city_name}}</li>
                    </ul>

                    <br><h4 class="card-block__title mb-4">Identitas</h4>

                    <ul class="icon-list">
                        @foreach($company->userProfile->typeIdentify as $identity)
                            <li><i class="zmdi zmdi-card zmdi-hc-fw"></i>{{$identity->pivot->user_type_identify_number}} - {{$identity->type_identify_name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="profile__info">
                    <h4 class="card-block__title mb-4">Data Perusahaan</h4>

                    <ul class="icon-list">
                        <li><i class="zmdi zmdi-city-alt zmdi-hc-fw"></i> {{$company->company_name}}</li>
                        <li><i class="zmdi zmdi-email"></i> {{$company->company_email}}</li>
                        <li><i class="zmdi zmdi-case zmdi-hc-fw"></i> Fax -  {{$company->company_fax}}</li>
                        <li><i class="zmdi zmdi-pin zmdi-hc-fw"></i> {{$company->company_address}}</li>
                        <li>
                            <div id="map" style="width: 100%; height: 300px;"></div>
                            <input id="company_latitude" type="hidden" name="company_latitude" value="{{ old('company_latitude', $company->company_latitude ?? '') }}">
                            <input id="company_longitude" type="hidden"  name="company_longitude" value="{{ old('company_longitude', $company->company_longitude ?? '') }}">
                        </li>
                    </ul>

                    <br><h4 class="card-block__title mb-4">Dokumen Perusahaan</h4>

                    <ul class="icon-list">
                        @foreach($company->companyDocuments as $document)
                            <li><i class="zmdi zmdi-file-text zmdi-hc-fw"></i>{{$document->document_type_name}} - {{$document->pivot->document_name}} | <a href="{{$document->pivot->download_url}}">[ <i class="zmdi zmdi-download zmdi-hc-fw"></i> ]</a></li>
                        @endforeach
                    </ul>
                </div>

                @if($company->company_status == '0')
                    <div class="profile__info">
                        <center>
                            <button type="button" onclick="acceptCompany(this)" data-id="{{$company->id}}" class="btn btn-success waves-effect">Terima</button>&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" onclick="rejectCompany(this)" data-id="{{$company->id}}" class="btn btn-danger waves-effect">Tolak</button>
                        </center>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        function acceptCompany(a) {
            var id=a.getAttribute('data-id');
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan memverifikasi pendaftaran perusahaan dan pelaku usaha?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                location.href='{{url('admin/verification/acc')}}/'+id;
            });
        }

        function rejectCompany(a) {
            var id=a.getAttribute('data-id');
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menolak verifikasi pendaftaran perusahaan dan pelaku usaha?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                //location.href='{{url('admin/verification')}}/'+id+'/2';
                swal({
                    title: 'Tuliskan alasan penolakan verifikasi',
                    input: 'text',
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    showLoaderOnConfirm: true,
                    allowOutsideClick: false
                }).then(function (alasan) {
                    swal({
                        type: 'success',
                        title: 'Penolakan verifikasi berhasil!`',
                        html: 'Alasan penolakan: ' + alasan
                    });
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:'post',
                        url:'rej/'+id,
                        data: 'alasan='+alasan,
                        success : function(cek){
                            location.href='{{url('admin/verification')}}';
                        }
                    });
                });
            });
        }
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
    <script type="text/javascript">
        function initialize() {

            var latlng = new google.maps.LatLng($('#company_latitude').val(),$('#company_longitude').val());
            var map = new google.maps.Map(document.getElementById('map'), {
                center: latlng,
                zoom: 13
            });
            var marker = new google.maps.Marker({
                map: map,
                position: latlng,
                draggable: false,
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
                $('#company_latitude').val(evt.latLng.lat().toFixed(5));
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endpush
