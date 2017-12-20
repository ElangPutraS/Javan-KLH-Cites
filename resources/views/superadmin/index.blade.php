@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola User</h1>
            </header>

            <div class="card">

                <div class="card-header">
                    <h2 class="card-title">Daftar User</h2>
                    <small class="card-subtitle"></small>
                </div>

                <div class="card-block">

                    @include('includes.notifications')
                    <a href="{{ route('superadmin.createUser') }}" class="btn btn-primary">Tambah Baru</a>
                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-default">
                            <tr>
                                <th width="50px">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status </th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ (($users->currentPage() - 1 ) * $users->perPage() ) + $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->roles->first()->role_name}}</td>
                                    @if($user->deleted_at === NULL )
                                            <td>Aktif</td>
                                            <td>
                                            <a href="{{route('superadmin.editUser',['id'=>$user->id])}}" class="btn btn-sm btn-primary"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                            <a onclick="deleteUser(this)" data-id="{{$user->id}}" class="btn btn-sm btn-danger" style="color:white;"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                        </td>
                                    @else
                                        <td>Non-Aktif</td>
                                        <td>
                                            <a onclick="restoreUser(this)" data-id="{{$user->id}}" class="btn btn-sm btn-warning" style="color:white;"><i class="zmdi zmdi-time-restore-setting zmdi-hc-fw"></i></a>
                                        </td>
                                    @endif

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Belum ada data.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <script src="{{asset('template/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        function deleteUser(a) {
            var id=a.getAttribute('data-id');
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan menghapus user ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                location.href="user/"+id+"/delete";
            });
        }

        function restoreUser(a) {
            var id=a.getAttribute('data-id');
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Akan mengembalikan user ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function() {
                location.href="user/"+id+"/restore";
            });
        }
    </script>
@endpush
