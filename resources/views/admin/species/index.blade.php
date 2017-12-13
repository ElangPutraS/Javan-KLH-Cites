@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Kelola Spesies & HS</h1>
        </header>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Daftar Spesies & HS</h2>
                <small class="card-subtitle"></small>
            </div>

            <div class="card-block">
                @include('includes.notifications')
                <a href="{{ route('admin.species.createSpecies') }}" class="btn btn-primary">Tambah Baru</a>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-default">
                        <tr>
                            <th>No</th>
                            <th>Nama Ilmiah</th>
                            <th>Nama Indonesia</th>
                            <th>Nama Umum</th>
                            <th>Appendiks</th>
                            <th>Komoditas</th>
                            <th>Kuota Tahun Ini</th>
                            <th>Kuota</th>
                            <th>Aksi</th>
                            <th>Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($species as $spec)
                            <tr>
                                <td>{{ (($species->currentPage() - 1 ) * $species->perPage() ) + $loop->iteration }}</td>
                                <td><i>{{$spec->species_scientific_name}}</i></td>
                                <td>{{$spec->species_indonesia_name}}</td>
                                <td>{{$spec->species_general_name}}</td>
                                <td>
                                    @if($spec->is_appendix!='')
                                        {{$spec->appendixSource->appendix_source_code}}
                                    @else
                                        Tidak Memiliki Appendix
                                    @endif
                                </td>
                                <td>{{$spec->speciesCategory->species_category_name}}</td>
                                <td>
                                    @foreach($spec->speciesQuota as $kuota)
                                        @if($kuota->year == date('Y'))
                                            {{ $kuota->quota_amount }}
                                        @else
                                            Kuota belum ditentukan
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{route('admin.species.showquota',['id'=>$spec->id])}}" class="btn btn-sm btn-info"><i class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                    <a href="{{ route('admin.species.createquota', ['species_id' => $spec->id]) }}" class="btn btn-sm btn-success"><i class="zmdi zmdi-plus-square zmdi-hc-fw"></i></a>
                                </td>
                                <td>
                                    <a href="{{route('admin.species.editSpecies', ['id' => $spec->id])}}" class="btn btn-sm btn-primary"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    <a onclick="deleteSpecies(this)" data-id="{{$spec->id}}" class="btn btn-sm btn-danger" style="color:white;"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                </td>
                                <td><a href="{{route('admin.species.detail', ['id'=> $spec->id])}}" class="btn btn-sm btn-info"><i class="zmdi zmdi-book zmdi-hc-fw" title="detail"></i></a></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">Data Kosong</td>
                            </tr>
                            @endforelse
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
    </script>
@endpush