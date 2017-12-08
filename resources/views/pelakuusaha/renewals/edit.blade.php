@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Pembaharuan SATS-LN</h1>
            </header>

            <div class="card">
                <div class="card-block">

                    @include('includes.notifications')

                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                        {!! csrf_field() !!}

                        @include('pelakuusaha.renewals._form')

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('user.renewal.index') }}" class="btn btn-default">Kembali ke Daftar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <script src="{{ asset('template/vendors/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/vendors/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template/vendors/bower_components/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('template/vendors/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('input[name="is_renewal"]').change(function(){
                if (document.getElementById('is_renewal1').checked) {
                    document.getElementById('showPeriod').style.display='block';
                    //$("#period").attr('required', '');
                    $("#port_exportation").attr('disabled','');
                    $("#port_destination").attr('disabled','');
                    $("#purpose_type_id").attr('disabled','');
                    $("#consignee").attr('readonly','');
                }else if(document.getElementById('is_renewal2').checked){
                    document.getElementById('showPeriod').style.display='none';
                    //$("#period").removeAttr('required');
                    $("#port_exportation").removeAttr('disabled','');
                    $("#port_destination").removeAttr('disabled','');
                    $("#purpose_type_id").removeAttr('disabled','');
                    $("#consignee").removeAttr('readonly','');
                }
            });
        });
    </script>
@endpush
