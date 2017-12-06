@extends('layouts.app')

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

    <div id="welcome-image">
        &nbsp;
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> Informasi Terbaru</h3>
                  </div>
                  @forelse($news as $key => $value)
                  <div class="panel-body">
                    <div class="news-date">{{ date('d', strtotime($value->created_at)) }}<hr>{{ date('M', strtotime($value->created_at)) }}</div>
                    <h3 class="news-title">{{ $value->title }}</h3>
                    <p>{{ limit_text($value->content, 50) }}</p>
                    <p><a>read more ></a></p>
                  </div>
                  @empty
                  <div class="panel-body">
                    Tidak ada informasi terbaru.
                  </div>
                  @endforelse
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bullhorn"></i> Pengumuman</h3>
                  </div>
                  <div class="panel-body">
                    Tidak ada pengumuman terbaru.
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
