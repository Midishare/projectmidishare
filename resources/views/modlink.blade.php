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
        <h2>Repository Link Dokumen MOD</h2>
    </div>
</section>

<section style="margin-top: 0.25rem;"> <!-- Mengurangi margin-top -->
    <div class="container">
        <div class="row align-items-center justify-content-end"> <!-- Menggunakan justify-content-end untuk memulai item dari kanan -->
            <div class="col-auto"> <!-- Menggunakan class 'col-auto' untuk bagian search -->
                <form action="{{ route('linkmod.showlinkmod') }}" method="GET" class="flex-grow-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" aria-describedby="searchHelpInline" placeholder="Search...">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<div class="container" style="margin-top: 2rem;">
    <div class="row">
        @foreach($linkmod as $repo)
        <div class="col-md-4 col-sm-6 mb-4"> <!-- Added col-sm-6 for responsiveness -->
            <div class="card h-100"> <!-- Ensure cards have equal height -->
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-dark">{{ $repo->judullinkmod }}</h5>
                    <a href="{{ $repo->linkdrivemod }}" target="_blank" class="mt-auto">{{ $repo->linkdrivemod }}</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="container" style="margin-top: 1.5rem;"> <!-- Menambahkan margin-top untuk jarak antara judul dan navbar -->
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            {{ $linkmod->links() }}
        </div>
    </div>
</div>

@endsection
