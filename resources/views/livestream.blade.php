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
        <p>No livestream available at the moment.</p>
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

    @media (max-width: 768px) {
        .livestream-container {
            margin-top: 10vh;
        }

        h1 {
            font-size: 1.5rem;
        }
    }
</style>
@endsection