@extends('layouts.layouts')

@section('content')
    <div>
        <a href="{{ route('belajarmandiri.show') }}" class="btn" style="margin-top:100px;">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="container margin-news">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <h1 class="card-title mb-5 text-center">{{ $belajarmandiri->judul }}</h1>
                    <img src="{{ asset('storage/icon/' . $belajarmandiri->gambar) }}" class=" image-head"
                        alt="{{ $belajarmandiri->judul }}">
                    <div class="card-body">
                        <p class="text-muted">
                        </p>
                        <div class="card-text mt-4">
                            {!! $belajarmandiri->deskripsi !!}
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

        .margin-news {
            margin-top: 200px;
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
