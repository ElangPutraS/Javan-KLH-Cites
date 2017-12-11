@extends('layouts.app2')

@section('content')
    <div class="row">
      <div class="carousel slide" id="carousel1">
        <div class="carousel-inner">
          <div class="item active">
            <img alt="image" class="img-responsive" src="{{ asset('images/twilight-forest-wallpaperr.jpg') }}">
          </div>
          <div class="item">
            <img alt="image" class="img-responsive" src="{{ asset('images/Forest-Wallpaperss.jpg') }}">
          </div>
        </div>
        <a data-slide="prev" href="#carousel1" class="left carousel-control">
        <span class="icon-prev"></span>
        </a>
        <a data-slide="next" href="#carousel1" class="right carousel-control">
        <span class="icon-next"></span>
        </a>
      </div>
    </div>

    <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <h1>{{ $news->title }}</h1>
            <small>by {{ $news->user->name }} at {{ date('l, d F Y', strtotime($news->created_at)) }}</small>
            <p>{{ $news->content }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        @if($newsPrev)
        <a class="btn btn-primary btn-block" href="{{ url('news', $newsPrev->id) }}">< Info sebelumnya</a>
        @endif
      </div>

      <div class="col-md-6">
        
      </div>

      <div class="col-md-3">
        @if($newsNext)
        <a class="btn btn-primary btn-block" href="{{ url('news', $newsNext->id) }}">Info selanjutnya ></a>
        @endif
      </div>
    </div>

@endsection
