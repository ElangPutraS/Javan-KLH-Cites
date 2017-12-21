@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Sumber Appendiks</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Sumber Appendiks</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">

                    @include('includes.notifications')

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-default">
                            <tr>
                                <th width="50px">No</th>
                                <th>Kode Appendiks</th>
                                <th>Deskripsi</th>
                                <th width="150px">Tanggal Dibuat</th>
                                <th width="150px">Tanggal Diperbarui</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($sources as $source)
                            <tr>
                                <td>{{ (($sources->currentPage() - 1 ) * $sources->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $source->source_code }}</td>
                                <td>{{ $source->source_description }}</td>
                                <td>{{ $source->created_at->toFormattedDateString() }}</td>
                                <td>{{ $source->updated_at->toFormattedDateString() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">Belum ada data.</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    {!! $sources->links('vendor.pagination.bootstrap-4') !!}

                </div>
            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        function deleteProvinces(a) {
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus data Provinsi ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                $(a).find('form').submit();
            });
        }
    </script>
@endpush
