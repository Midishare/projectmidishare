@extends('layouts.layouts')

@section('content')
<div class="container text-center livestream-container">
    <h1>Livestream Event</h1>

    @if($livestream && $livestream->url)
        <div class="video-container">
            <iframe src="{{ $livestream->url }}?autoplay" 
                    title="YouTube livestream" frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe>
        </div>
    @else
    <div class="form-container">
        <h1 class="form-header text-center">Belum ada livestream nih, Midiers!</h1>
        <p class="form-label text-center">Tungguin ya! sambil nunggu kita nyanyi dulu</p>
        <div class="row">
            <div class="col-md-6 mb-5">
                <img id="rotatingIcon" class="icon-form" src="{{ asset('icon/waitinglivestream.png') }}" alt="">
            </div>
            <div class="col-md-6 text-desktop">
                <p>Satu bulan</p>
                <div class="audio-player">
                    <audio id="waitingAudio" controls>
                        <source src="{{ asset('audio/Satu_bulan.mp3') }}" type="audio/mpeg">
                        Browser anda tidak support!
                    </audio>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
    .livestream-container {
        margin-top: 10vh;
        width: 100%;
        max-width: 1200px;
        padding: 0 15px;
    }

    .video-container {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
    }

    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    .form-container {
            color: white;
            background-color: #0253BB;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
        }
        .text-desktop{
            margin-top: 100px;
        }
        .audio-player {
        margin-top: 20px;
        }
        .audio-player audio {
        width: 100%;
        }
        .icon-form {
        height: 50vh;
        transition: transform 0.5s ease-in-out;
    }
    .icon-form.rotating {
        animation: rotate 10s linear infinite;
    }
    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
    @media (max-width: 768px) {
        .livestream-container {
            margin-top: 10vh;
        }

        h1 {
            font-size: 1.5rem;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const audio = document.getElementById('waitingAudio');
        const icon = document.getElementById('rotatingIcon');

        audio.addEventListener('play', function() {
            icon.classList.add('rotating');
        });

        audio.addEventListener('pause', function() {
            icon.classList.remove('rotating');
        });

        audio.addEventListener('ended', function() {
            icon.classList.remove('rotating');
        });
    });
</script>
@endsection