@extends('layouts.layouts')

@section('content')

<style>
    /* Gaya CSS tambahan */
    .back-button {
        margin-top: 1rem;
    }

    @media (max-width: 768px) {
        .gradient-bg.py-5 {
            padding-top: 2rem;
        }
    }

    .card-title a {
        color: black;
        text-decoration: none;
    }

    .card-title a:hover {
        text-decoration: underline;
    }

    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
    }

    .back-button {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    h4 {
        margin-top: 0.2rem;
        margin-bottom: 0;
    }
</style>

<section class="gradient-bg py-5">
    <div class="container-fluid p-4 d-flex align-items-center justify-content-between">
        <a href="javascript:history.back()" class="btn back-button">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="container text-center">
        <h3>IKT - Video</h3>
    </div>
</section>

<section style="margin-top: 0.25rem;">
    <div class="container">
        <div class="row align-items-center justify-content-end">
            <div class="col-auto">
                <form action="{{ route('ikt.video') }}" method="GET" class="flex-grow-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" aria-describedby="searchHelpInline" placeholder="Search...">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section style="margin-top: 2rem;">
    <div class="container">
        <div class="row">
            @foreach($videos as $i => $video)
            <div class="col-lg-4 mb-4">
                <div class="card h-180">
                    <div class="">
                        <p class="card-text">
                    @php
                    $video_id = '';
                    $video_url = $video->video_link;
                    
                        // Cek apakah URL berasal dari YouTube
                        if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
                            if (strpos($video_url, 'youtu.be') !== false) {
                                // Format pendek (youtu.be)
                                $url_parts = explode('/', $video_url);
                                $video_id = end($url_parts);
                                // Hapus parameter setelah tanda tanya jika ada
                                $video_id = explode('?', $video_id)[0];
                            } elseif (strpos($video_url, 'youtube.com') !== false) {
                                // Format panjang (youtube.com)
                                parse_str(parse_url($video_url, PHP_URL_QUERY), $query);
                                $video_id = $query['v'] ?? '';
                            }
                        }
                    @endphp
            @if(!empty($video_id))
                <a href="{{ $video_url }}" target="_blank" class="card-link">
                    <img src="https://img.youtube.com/vi/{{ $video_id }}/0.jpg" alt="Thumbnail" class="video-thumbnail" width="100%" height="200">
                </a>
                <h5 class="card-subtitle mb-2 text-bold p-2">{{ $video->title }}</h5>
            @else
                <span>Format tidak didukung</span>
            @endif
            </p>
        </div>
    </div>
</div>
@endforeach
           
        </div>
        {{ $videos->links() }}
    </div>
</section>

@endsection
