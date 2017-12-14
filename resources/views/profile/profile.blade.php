@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Profil Pengguna</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Data Profil Pengguna</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">

                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" id="form-submission">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <h5>A. Informasi Pelaku Usaha</h5>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nama</label>
                            <div class="col-sm-14">
                                <input type="text" name="name" class="form-control" value="{{ old('name', array_get($user, 'name')) ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Email Pelaku Usaha</label>
                            <div class="col-sm-14">
                                <input type="text" name="email" class="form-control" value="{{ old('email', array_get($user, 'email')) ?? '' }}" readonly>
                            </div>
                        </div>

                        @can('access-pelaku-usaha')
                        <div class="form-group">
                            <label class="control-label">Tempat Tanggal Lahir</label>
                            <div class="col-sm-14">
                                <input type="text" name="name" class="form-control" value="{{$user->userProfile->place_of_birth}}, {{Carbon\Carbon::parse($user->userProfile->date_of_birth)->format('d-m-Y') ?? ''}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Alamat</label>
                            <div class="col-sm-14">
                                <input type="text" name="address" class="form-control" value="{{$user->userProfile->address.', '.$user->userProfile->city->city_name_full.', Provinsi '.$user->userProfile->province->province_name.', '.$user->userProfile->country->country_name }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Nomor Telepon</label>
                            <div class="col-sm-14">
                                <input type="text" name="address" class="form-control" value="{{$user->userProfile->mobile ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Nomor Identitas</label>
                            <div class="col-sm-14">
                                <input type="text" name="identity_number" class="form-control" value="{{ old('identity_number', array_get($user->userProfile->typeIdentify->first()->pivot, 'user_type_identify_number')) ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>B. Informasi Perusahaan</h5>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Nama Perusahaan</label>
                            <div class="col-sm-14">
                                <input type="text" name="company_name" class="form-control" value="{{ old('identity_number', array_get($user->userProfile->company, 'company_name')) ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Nama Pemilik Perusahaan</label>
                            <div class="col-sm-14">
                                <input type="text" name="company_name" class="form-control" value="{{ old('identity_number', array_get($user->userProfile->company, 'company_name')) ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Nomor Faksimile</label>
                            <div class="col-sm-14">
                                <input type="text" name="company_fax" class="form-control" value="{{ old('company_fax', array_get($user->userProfile->company, 'company_fax')) ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Email Perusahaan</label>
                            <div class="col-sm-14">
                                <input type="text" name="company_email" class="form-control" value="{{$company->company_email ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Alamat Perusahaan</label>
                            <div class="col-sm-14">
                                <input type="text" name="company_address" class="form-control" value="{{$user->company->company_address.', '.$user->company->city->city_name_full.', Provinsi '.$user->company->province->province_name.', '.$user->company->country->country_name }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Lokasi Perusahaan</label>
                            <div class="col-sm-14">
                                <div id="map" style="width: 100%; height: 300px;"></div>
                                <input id="company_latitude" type="hidden" name="company_latitude" value="{{ old('company_latitude', $company->company_latitude ?? '') }}">
                                <input id="company_longitude" type="hidden"  name="company_longitude" value="{{ old('company_longitude', $company->company_longitude ?? '') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Alamat Penangkaran</label>
                            <div class="col-sm-14">
                                <input type="text" name="captivity_address" class="form-control" value="{{$user->company->captivity_address}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Total Pekerja</label>
                            <div class="col-sm-14">
                                <input type="text" name="labor_total" class="form-control" value="{{$user->company->labor_total}} Orang" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Total Investasi</label>
                            <div class="col-sm-14">
                                <input type="text" name="investation_total" class="form-control" value="Rp. {{ number_format($user->company->investation_total,2,',','.')}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Nomor NPWP Perusahaan</label>
                            <div class="col-sm-14">
                                <input type="text" name="npwp_number" class="form-control" value="{{$user->company->npwp_number}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Masa Berlaku Surat Izin Edar Berakhir</label>
                            <div class="col-sm-14">
                                <input type="text" name="date_distribution" class="form-control" value="{{Carbon\Carbon::parse($user->company->date_distribution)->format('d-m-Y')}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>C. Dokumen Perusahaan</h5>
                        </div>
                        <div class="card">
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table id="data-table" class="table table-bordered">
                                        <thead class="thead-default">
                                        <tr>
                                            <th>No</th>
                                            <th>Document Type</th>
                                            <th>Document Name</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no=1;?>
                                        @foreach($company->companyDocuments as $document)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $document->document_type_name }}</td>
                                                <td>{{ $document->pivot->document_name }}</td>
                                                <td><a href="{{  $document->pivot->download_url }}"> <i class="zmdi zmdi-download zmdi-hc-fw"></i> Download</a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endcan


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <center>
                                    <a href="{{ route('profile.edit') }}" class="btn btn-success">Ubah Profil</a> &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('dashboard.home.index') }}" class="btn btn-default">Kembali ke Beranda</a>
                                </center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <!-- Data Table -->
    <script src="{{ asset('template/vendors/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/vendors/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template/vendors/bower_components/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('template/vendors/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>

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
