@extends('layouts.app3')

@section('content')
    <style>
        .marquee {
            margin: 0 auto;
            overflow: hidden;
            white-space: nowrap;
        }
        .marquee span {
            display: inline-block;
            font-size: 20px;
            position: relative;
            left: 100%;
            animation: marquee 12s linear infinite;
        }
        .marquee:hover span {
            animation-play-state: paused;
        }

        .marquee span:nth-child(1) {
            animation-delay: 0s;
        }
        .marquee span:nth-child(2) {
            animation-delay: 2.4s;
        }
        .marquee span:nth-child(3) {
            animation-delay: 4.8s;
        }

        @keyframes marquee {
            0%   { left: 100%; }
            100% { left: -100%; }
        }
    </style>
    <?php
    function limit_text($text, $limit)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }
    ?>

    <div class="container">
        <!-- Call to Action Well -->
        <div class="row">
            <div class="col-lg-12">
                <div class="well text-center marquee">
                    <?php $tmp = 0; ?>
                    @forelse($news as $key => $value)
                    <?php
                        if ($tmp == 3) {
                            break;
                        }
                    ?>
                    <span>{{ $value->title }}</span>
                    <?php
                        $tmp += 1;
                    ?>
                    @empty
                    <span>E-SATS-LN KEMENTERIAN LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA</span>
                    @endforelse
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            @forelse($news as $key => $value)
                <div class="col-md-4">
                    <h2>{{ $value->title }}</h2>
                    <small>Oleh <b><i>{{ $value->user->name }}</i></b>
                        pada {{ date('l, d F Y', strtotime($value->created_at)) }}</small>
                    <br>
                    <div style="height: 100px; overflow: hidden;">
                        {!! limit_text($value->content, 50) !!}
                    </div>
                    <br>
                    <a class="btn btn-success btn-sm" href="{{ url('news', $value->id) }}">Baca selanjutnya...</a>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert">Tidak ada informasi terbaru.</div>
                </div>
        @endforelse
        <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->

    </div>

@endsection
