@extends('layouts.layouts')

@section('content')
    <div>
        <a href="{{ route('berita.show') }}" class="btn" style="margin-top:100px;">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="container margin-news">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/event_images/' . $event->image) }}" class="image-head text-center"
                        alt="{{ $event->title }}">
                    <div class="card-body">
                        {{-- <span class="badge bg-primary mb-2">{{ $event->category }}</span> --}}
                        <h1 class="card-title">{{ $event->title }}</h1>
                        <p class="text-muted">
                            {{-- <small>
                            <i class="bi bi-clock"></i> {{ $event->created_at->diffForHumans() }}
                            @if ($event->author)
                                • <i class="bi bi-person"></i> {{ $event->author }}
                            @endif
                        </small> --}}
                        </p>
                        <div class="card-text mt-4">
                            {!! $event->description !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        .image-head {
            object-fit: fill;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .card-img-top {
            height: 300px;
            object-fit: cover;
        }

        .card-title {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.5em 1em;
        }

        .card-text {
            font-size: 1.1rem;
            line-height: 1.6;
        }
    </style>
@endsection
