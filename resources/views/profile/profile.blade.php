@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Profile</div>

                    <div class="panel-body">
                        <table>
                            <tr>
                                <th style="padding: 2px; color:red;" colspan="3">Personal Profile</th>
                            </tr>
                            <tr>
                                <th style="padding: 2px;">Name</th>
                                <td style="padding: 2px;">:</td>
                                <td style="padding: 2px;">{{$user->name}}</td>
                            </tr>
                            <tr>
                                <th style="padding: 2px;">Email</th>
                                <td style="padding: 2px;">:</td>
                                <td style="padding: 2px;">{{$user->email}}</td>
                            </tr>

                            @if($user->hasRole('Pelaku Usaha'))
                            <tr>
                                <th style="padding: 2px;">Place and Date Birth</th>
                                <td style="padding: 2px;">:</td>
                                <td style="padding: 2px;">{{$user->userProfile->place_of_birth}}, {{Carbon\Carbon::parse($user->userProfile->date_of_birth)->format('d-m-Y')}}</td>
                            </tr>
                            <tr>
                                <th style="padding: 2px;">Address</th>
                                <td style="padding: 2px;">:</td>
                                <td style="padding: 2px;">{{$user->userProfile->address}}, {{$user->userProfile->city->city_name}}</td>
                            </tr>
                            <tr>
                                <th style="padding: 2px;">Mobile</th>
                                <td style="padding: 2px;">:</td>
                                <td style="padding: 2px;">{{$user->userProfile->mobile}}</td>
                            </tr>
                            <tr>
                                <th style="padding: 2px; color:red;" colspan="3">Company Profile</th>
                            </tr>
                            <tr>
                                <th style="padding: 2px;">Company Name</th>
                                <td style="padding: 2px;">:</td>
                                <td style="padding: 2px;">{{$company->company_name}}</td>
                            </tr>
                            <tr>
                                <th style="padding: 2px;">Company Email</th>
                                <td style="padding: 2px;">:</td>
                                <td style="padding: 2px;">{{$company->company_email}}</td>
                            </tr>
                            <tr>
                                <th style="padding: 2px;">Company Fax</th>
                                <td style="padding: 2px;">:</td>
                                <td style="padding: 2px;">{{$company->company_fax}}</td>
                            </tr>
                            <tr>
                                <th style="padding: 2px;">Company Address</th>
                                <td style="padding: 2px;">:</td>
                                <td style="padding: 2px;">{{$company->company_address}}</td>
                            </tr>
                            @endif

                        </table>

                        @if($user->hasRole('Pelaku Usaha'))

                        <div id="map" style="width: 100%; height: 300px;"></div>
                        <input id="company_latitude" type="hidden" name="company_latitude" value="{{ old('company_latitude', $company->company_latitude ?? '') }}">
                        <input id="company_longitude" type="hidden"  name="company_longitude" value="{{ old('company_longitude', $company->company_longitude ?? '') }}">
                        <br>
                        <table>
                            <tr>
                                <th style="padding: 2px; color:red;" colspan="3">Document Company</th>
                            </tr>
                            <tr style="border:1px;">
                                <th style="padding: 2px;">No</th>
                                <th style="padding: 2px;">Document Type</th>
                                <th style="padding: 2px;">Document Name</th>
                                <th style="padding: 2px;">Action</th>
                            </tr>
                            @foreach($company->companyDocuments as $document)
                                <tr>
                                    <th style="padding: 2px;">{{ $loop->iteration }}</th>
                                    <td style="padding: 2px;">{{ $document->document_type_name }}</td>
                                    <td style="padding: 2px;">{{ $document->pivot->document_name }}</td>
                                    <td style="padding: 2px;"><a href="{{  $document->pivot->download_url }}" class="btn-success">Download</a></td>
                                </tr>
                            @endforeach
                        </table>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
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
            //document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
            $('#company_latitude').val(evt.latLng.lat().toFixed(5));
            $('#company_longitude').val(evt.latLng.lng().toFixed(5));
            //alert($('#company_latitude').val()+' '+$('#company_longitude').val());
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>