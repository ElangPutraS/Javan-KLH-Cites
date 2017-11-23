@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Edit Pelaku Usaha</h1>
            </header>

            <div class="card">
                <div class="card-block">

                    @include('includes.notifications')

                    <form action="{{ route('admin.companies.update', $company) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        {{ method_field('PUT') }}

                        {!! csrf_field() !!}

                        @include('admin.companies._form', ['company' => $company])

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.companies.index') }}" class="btn btn-default">Kembali ke Daftar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
<?php
$doc_type='';
foreach ($document_type as $key=>$dt){
    $doc_type.='<option value="'.$key.'">'.$dt.'</option>';
}
?>
@push('body.script')
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
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
        function getState(a) {
            var country=$('#country_id').val();
            $.ajax({
                type: 'get',
                url:  window.baseUrl +'/getProvince/'+country,
                dataType: 'json',
                success : function (data) {
                    //alert(data);
                    var element='<option value="">--Pilih Provinsi--</option>';
                    for(var i=0; i<data.length; i++){
                        element+='<option value="'+data[i].id+'">'+data[i].province_name+'</option>';
                    }
                    $('#province_id').html(element);
                }
            });
        }

        function getCity(a) {
            var province=$('#province_id').val();
            $.ajax({
                type: 'get',
                url:  window.baseUrl +'/getCity/'+province,
                dataType: 'json',
                success : function (data) {
                    var element='<option value="">--Pilih Kota--</option>';
                    for(var i=0; i<data.length; i++){
                        element+='<option value="'+data[i].id+'">'+data[i].city_name_full+'</option>';
                    }
                    $('#city_id').html(element);
                }
            });
        }

        function getStateCompany(a) {
            var country=$('#company_country_id').val();
            $.ajax({
                type: 'get',
                url:  window.baseUrl +'/getProvince/'+country,
                dataType: 'json',
                success : function (data) {
                    //alert(data);
                    var element='<option value="">--Pilih Provinsi Perusahaan--</option>';
                    for(var i=0; i<data.length; i++){
                        element+='<option value="'+data[i].id+'">'+data[i].province_name+'</option>';
                    }
                    $('#company_province_id').html(element);
                }
            });
        }

        function getCityCompany(a) {
            var city=$('#company_province_id').val();
            $.ajax({
                type: 'get',
                url:  window.baseUrl +'/getCity/'+city,
                dataType: 'json',
                success : function (data) {
                    var element='<option value="">--Pilih Kota Perusahaan--</option>';
                    for(var i=0; i<data.length; i++){
                        element+='<option value="'+data[i].id+'">'+data[i].city_name_full+'</option>';
                    }
                    $('#company_city_id').html(element);
                }
            });
        }

        function tambahForm(a) {
            var form='<div id="dynamic"><div class="form-group"><label class="control-label">Dokumen</label><div class="row">';
            form +='<div class="col-sm-10"><select id="document_type" class="form-control" name="document_type[]" required><option value="">--Choose Document Type--</option>';
            form +='<?=$doc_type?>';
            form +='</select></div><div class="col-sm-2"><button onclick="hapusForm(this)" class="btn btn-danger">X</button></div></div></div>';
            form +='<div class="form-group"><label class="control-label"></label><div class="col-sm-14"><input id="company_file" type="file" class="form-control" name="company_file[]" accept="file_extension" required></div></div></div>';
            $('#form-dynamic').append(form);
        }

        function hapusForm(a) {
            a.closest('#dynamic').remove();
        }

        function deleteFile(a) {
            var type_id=a.getAttribute('data-type-id');
            var company_id=a.getAttribute('data-company-id');
            var document_name=a.getAttribute('data-document-name');
            $.ajax({
                type: 'get',
                url: '/deleteDoc/'+type_id+'/'+company_id+'/'+document_name,
                success : function (data) {
                    a.closest('#file_download').remove();
                    //alert(data);
                }
            });
        }
    </script>
@endpush