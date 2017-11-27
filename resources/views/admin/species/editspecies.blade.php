@extends('dashboard.layouts.base')

@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Kelola Spesies & HS</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Ubah Spesies & HS</h2>
                    <small class="card-subtitle"></small>
                </div>
                <div class="card-block">

                    @include('includes.notifications')

                    <form action="{{route('admin.species.updateSpecies', ['id' => $species->id])}}" method="post" enctype="application/x-www-form-urlencoded" class="form-horizontal">

                        {!! csrf_field() !!}

                        @include('admin.species._formspecies', ['species' => $species])

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-14">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.species.index') }}" class="btn btn-default">Kembali ke Daftar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('body.script')
    <script type="text/javascript">
        $(document).ready(function(){      
            $('input[name="is_appendix"]').change(function(){
                if (document.getElementById('is_appendix1').checked) {
                   document.getElementById('showAppendix').style.display='block';
                    $("#appendix_source_id").attr('required', '');
                }else if(document.getElementById('is_appendix2').checked){
                    document.getElementById('showAppendix').style.display='none';
                    $("#appendix_source_id").removeAttr('required');
                }
            }); 
        });
    </script>
@endpush