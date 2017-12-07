@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Edit User Role</h1>
            </header>

            <div class="card">
                <div class="card-block">

                    @include('includes.notifications')

                    <form action="{{route('superadmin.updateUser', ['id' => Request::segment(3)])}}" method="post" enctype="multipart/form-data" class="form-horizontal">

                        {!! csrf_field() !!}

                        @include('superadmin._form')

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('superadmin.index') }}" class="btn btn-default">Kembali ke Daftar</a>
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
