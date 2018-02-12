@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Ubah Password</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Ubah Password</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">

                    @include('includes.notifications')

                    <form action="{{ route('profile.updatePassword', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="control-label">Kata Sandi</label>
                            <div class="col-sm-14">
                                <input type="password" name="old_password" id="old_password" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Kata Sandi Baru</label>
                            <div class="col-sm-14">
                                <input type="password" id="new_password" name="new_password" class="form-control" onkeyup="confirmPassword(this)" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label"> Konfirmasi Kata Sandi Baru </label>
                            <div class="col-sm-14" id="password_warning">
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" onkeyup="confirmPassword(this)" required>
                                <span id="note" style="font-size: 9pt; color: #ffc107;"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-primary" id="savePassword">Simpan</button>
                                <a href="{{ route('profile') }}" class="btn btn-default">Kembali ke Profil</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('body.script')
    <script>
        function confirmPassword(a) {
            var pass = $('#new_password').val();
            var pass2 = $('#confirm_password').val();
            if(pass != pass2){
                $('#password_warning').addClass('has-warning');
                $('#confirm_password').addClass('form-control-warning');
                $('#savePassword').prop( "disabled", true );
                $('#note').html( "Kata sandi yang dimasukan harus sama dengan kata sandi baru" );
            }else{
                $('#password_warning').removeClass('has-warning');
                $('#confirm_password').removeClass('form-control-warning');
                $('#savePassword').prop( "disabled", false );
                $('#note').html( "" );
            }
        }
    </script>
@endpush