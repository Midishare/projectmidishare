@extends('layouts.layouts')

@section('content')
<style>
    /* Gaya CSS tambahan */
    .back-button {
        margin-top: 1rem; /* Menambahkan margin-top untuk jarak antara judul dan navbar */
    }

    @media (max-width: 768px) {
        .gradient-bg.py-5 {
            padding-top: 2rem; /* Penyesuaian padding atas untuk tampilan responsif */
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
      <h4>Repository Knowledge Warehouse</h4>
    </div>
</section>

<section style="margin-top: 0.25rem;"> <!-- Mengurangi margin-top -->
    <div class="container">
        <div class="row align-items-center justify-content-end"> <!-- Menggunakan justify-content-end untuk memulai item dari kanan -->
            <div class="col-auto"> 
                <form action="{{ route('videowh.showvideomodwh') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" aria-describedby="searchHelpInline" placeholder="Search...">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section style="margin-top: 2rem;">
    <div class="container">
        <div class="row">
            @foreach($videowh as $i => $video)
            <div class="col-lg-4 mb-4">
                <div class="card h-180">
                    <div class="card-body">
                        <p class="card-text">
                            @php
                                $video_id = '';
                                $video_url = $video->linkwh;
                                if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
                                    $url_parts = parse_url($video_url);
                                    parse_str($url_parts['query'], $query);
                                    
                                    if (isset($query['v'])) {
                                        $video_id = $query['v'];
                                    } else {
                                        $path_parts = explode('/', $url_parts['path']);
                                        $video_id = end($path_parts);
                                    }
                                }
                            @endphp
                            @if(!empty($video_id))
                                <a href="{{ $video_url }}" target="_blank" class="card-link">
                                    <img src="https://img.youtube.com/vi/{{ $video_id }}/0.jpg" alt="Thumbnail" class="video-thumbnail" width="100%" height="200">
                                </a>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $video->judulvidwh }}</h6>
                            @else
                                <span>Format tidak didukung</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{ $videowh->links() }}
    </div>
</section>
@endsection