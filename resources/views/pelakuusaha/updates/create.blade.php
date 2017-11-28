@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Permohonan SATSL-LN Pengguna</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Pengajuan Permohonan SATSL-LN Langsung</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">
                    <?php
                    /*$tahun=date('Y');
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

                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" id="form-submission">
                        {!! csrf_field() !!}

                        @include('pelakuusaha.submission._form', ['trade_permit' => null])

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-primary">Simpan Baru</button>
                                <a href="" class="btn btn-default">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endsection