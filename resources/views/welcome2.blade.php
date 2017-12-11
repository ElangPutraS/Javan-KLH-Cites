@extends('layouts.app2')

@section('content')
    <?php
    function limit_text($text, $limit) {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }
    ?>

    <div class="row">
      <div class="carousel slide" id="carousel1">
        <div class="carousel-inner">
          <div class="item active">
            <img alt="image" class="img-responsive" src="{{ asset('images/twilight-forest-wallpaperrr.jpg') }}">
          </div>
          <div class="item">
            <img alt="image" class="img-responsive" src="{{ asset('images/Forest-Wallpapersss.jpg') }}">
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

    <div class="row klh-content">
      <div class="col-md-6">
        <div class="panel panel-default panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i> Informasi Terbaru</h3>
          </div>
          @forelse($news as $key => $value)
            <div class="panel-body">
              <h3 class="news-title">
                {{ $value->title }}
                <br>
                <small>by {{ $value->user->name }} at {{ date('l, d F Y', strtotime($value->created_at)) }}</small>
              </h3>
              <p>{{ limit_text($value->content, 50) }}</p>
              <p><a href="{{ url('news', $value->id) }}"><small>Read more...</small></a></p>
            </div>
          @empty
            <div class="panel-body">
              Tidak ada informasi terbaru.
            </div>
          @endforelse
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel panel-default panel-warning">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-bullhorn"></i> Pengumuman</h3>
          </div>
          <div class="panel-body">
            Tidak ada pengumuman terbaru.
          </div>
        </div>
      </div>
    </div>

@endsection
