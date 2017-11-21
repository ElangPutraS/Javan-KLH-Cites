@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Daftar Spesies & HS</h1>
        </header>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Daftar Spesies & HS</h2>
                <small class="card-subtitle"></small>
            </div>

            <div class="card-block">
                @include('includes.notifications')
                <a href="{{ route('admin.species.createSpecies') }}" class="btn btn-primary">Tambah Baru</a>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-default">
                        <tr>
                            <th>No</th>
                            <th>Nama Ilmiah</th>
                            <th>Nama Indonesia</th>
                            <th>Nama Umum</th>
                            <th>Appendiks</th>
                            <th>Jenis Kelamin</th>
                            <th>Kuota</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $a=1; ?>
                        @if(count($species)>0)
                            @foreach($species as $spec)
                                <tr>
                                    <td>{{$a++}}</td>
                                    <td>{{$spec->species_scientific_name}}</td>
                                    <td>{{$spec->species_indonesia_name}}</td>
                                    <td>{{$spec->species_general_name}}</td>
                                    <td>
                                        @if($spec->is_appendix!='')
                                            {{$spec->appendixSource->appendix_source_code}}
                                        @else
                                            Tidak Memiliki Appendix
                                        @endif
                                    </td>
                                    <td>{{$spec->speciesSex->sex_name}}</td>
                                    <td>
                                        <a href="{{route('admin.species.showquota',['id'=>$spec->id])}}"><i class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a href="{{ route('admin.species.createquota', ['species_id' => $spec->id]) }}"><i class="zmdi zmdi-plus-square zmdi-hc-fw"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.species.editSpecies', ['id' => $spec->id])}}"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                        <a style="color:#3eacff;" onclick="deleteSpecies(this)" data-id="{{$spec->id}}"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8"><center>Data Kosong</center></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                {{ $species->links() }}
            </div>
        </div>

    </section>
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        function deleteSpecies(a) {
            var id=a.getAttribute('data-id');
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus species ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                location.href="species/"+id+"/delete";
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
@endpush