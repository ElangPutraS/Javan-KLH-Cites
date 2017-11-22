@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Form Permohonan SATLN Langsung</h1>
            </header>

            <div class="card">
                <div class="card-block">
                    <?php
                       /* $tahun=date('Y');
                        $tambah=mktime(0,0,0,date('m')+6,date('d')+0,date('Y')+0);
                        $cek=date('Y', $tambah);
                        if($cek>$tahun){
                            echo '
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading">Tidak Diizinkan Mengajukan Permohonan</h4>
                                    <p>Waktu pengajuan tidak sesuai, silahkan mengajukan permohonan pada awal tahun atau mengajukan permohonan bertingkat.</p>
                                </div>
                            ';
                        }*/
                    ?>
                    @include('includes.notifications')

                    <form action="{{route('user.submission.storeDirect')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        {!! csrf_field() !!}

                        @include('pelakuusaha.submission._form', ['trade_permit' => null])

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-primary" <?php //if($cek>$tahun){echo 'disabled title="tidak diizinkan melakukan permohonan langsung"';}?>>Simpan Baru</button>
                                <a href="{{ route('admin.companies.index') }}" class="btn btn-default">Batal</a>
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
@endpush