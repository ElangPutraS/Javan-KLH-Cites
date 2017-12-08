@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Kabupaten/Kota</h1>
            </header>

            <div class="card">
                 <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Tambah Kabupaten/Kota</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">

                    @include('includes.notifications')

                    <form action="{{ route('admin.cities.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        {!! csrf_field() !!}

                        @include('admin.cities._form', ['city' => null])

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-primary">Simpan Baru</button>
                                <a href="{{ route('admin.cities.index') }}" class="btn btn-default">Batal</a>
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
@endpush