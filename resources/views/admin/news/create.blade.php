@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Tambah Informasi</h1>
            </header>

            <div class="card">
                <div class="card-block">

                    @include('includes.notifications')

                    <form action="{{ route('admin.news.store') }}" method="post" enctype="application/x-www-form-urlencoded" class="form-horizontal">
                        {!! csrf_field() !!}

                        @include('admin.news._form')

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-primary">Simpan Baru</button>
                                <a href="{{ route('admin.news.index') }}" class="btn btn-default">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('body.script')
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
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);

        function getStateCompany(a) {
            var country=$('#company_nation').val();
            $.ajax({
                type: 'get',
                url: '/getProvince/'+country,
                dataType: 'json',
                success : function (data) {
                    //alert(data);
                    var element='<option value="">--Choose Company State--</option>';
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
                url: '/getCity/'+city,
                dataType: 'json',
                success : function (data) {
                    var element='<option value="">--Choose Company City--</option>';
                    for(var i=0; i<data.length; i++){
                        element+='<option value="'+data[i].id+'">'+data[i].city_name_full+'</option>';
                    }
                    $('#company_city').html(element);
                }
            });
        }
    </script>
@endpush