@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
            </header>

            <div class="card">

                <div class="card-header">
                    <h2 class="card-title">Perubahan Permohonan SATSL-LN Pengguna</h2>
                    <small class="card-subtitle"></small>
                </div>

                <div class="card-block">

                    @include('includes.notifications')
                    <form class="navbar-form" role="search">
                        <div class="form-group">
                            <label class="control-label">Cek Nomor SATS-LN</label>
                            <div class="col-sm-14">
                                <div class="input-group">
                                    <input id="search" name="search" type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                                        <a onclick="noSubmission(this)" class="btn btn-default"><li class="zmdi zmdi-search zmdi-hc-fw"></li></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
               </div>
            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        function noSubmission() {
            var no=$('#search').val();
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url:  window.baseUrl +"/getSubmission",
                data: 'no='+no,

                success : function (data) {
                    if (data==0){
                        swal(
                            "Error",
                            "Nomor SATS-LN tidak ditemukan",
                            "error"
                        )
                    }else{
                    location.href="updateSubmission/"+data;
                    }
                }

            });
        }
    </script>
@endpush
