@extends('layouts.app3')

@section('content')
    <div class="container">
        <div class="row klh-content">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>{{ $news->title }}</h1>
                        <small>by {{ $news->user->name }}
                            at {{ date('l, d F Y', strtotime($news->created_at)) }}</small>
                        <hr>
                        {!! $news->content !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                @if($newsPrev)
                    <a class="btn btn-success btn-block" href="{{ url('news', $newsPrev->id) }}">< Info sebelumnya</a>
                @endif
            </div>

            <div class="col-md-6">

            </div>

            <div class="col-md-3">
                @if($newsNext)
                    <a class="btn btn-success btn-block" href="{{ url('news', $newsNext->id) }}">Info selanjutnya ></a>
                @endif
            </div>
        </div>
    </div>
@endsection
