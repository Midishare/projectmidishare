@extends('layouts.layouts')

@section('content')
    <style>
        /* Additional CSS Styles */
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

        .video-thumbnail {
            width: 100%;
            height: 200px;
            /* Fixed height for consistency */
            object-fit: cover;
            /* This ensures the image covers the area without distortion */
        }
    </style>

    <section class="gradient-bg py-5">
        <div class="container-fluid p-4 d-flex align-items-center justify-content-between">
            <a href="javascript:history.back()" class="btn back-button">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="container text-center">
            <h3>Video SME</h3>
        </div>
    </section>

    <section style="margin-top: 0.25rem;">
        <div class="container">
            <div class="row align-items-center justify-content-end">
                <div class="col-auto">
                    <form action="{{ route('videoogm.showvideomodogm') }}" method="GET" class="flex-grow-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" aria-describedby="searchHelpInline"
                                placeholder="Search...">
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
                @foreach ($videoogm as $i => $video)
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                @if ($video->image_path)
                                    <a href="{{ $video->linkogm }}" target="_blank" class="card-link">
                                        <img src="{{ Storage::url($video->image_path) }}" alt="Video Thumbnail"
                                            class="video-thumbnail rounded mb-3">
                                    </a>
                                @else
                                    <div class="text-center p-4 bg-light rounded mb-3">
                                        <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                                        <p class="mt-2 mb-0">No thumbnail available</p>
                                    </div>
                                @endif
                                <h5 class="card-subtitle mb-2 text-bold">{{ $video->judulvidogm }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $videoogm->links() }}
        </div>
    </section>
@endsection
