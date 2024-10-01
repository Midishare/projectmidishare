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
        color: #007bff; /* Warna link */
        text-decoration: none;
    }

    .card-title a:hover {
        text-decoration: underline;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan */
        border-radius: 10px; /* Sudut melengkung */
        overflow: hidden; /* Mengatasi overflow pada bayangan */
        border: none;
    }

    .card:hover {
        transform: translateY(-5px); /* Efek hover */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Bayangan saat hover */
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

    .input-group {
        border: 1px solid #ced4da; /* Warna border input */
        border-radius: 5px; /* Sudut melengkung input */
        overflow: hidden;
    }

    .input-group input {
        border: none; /* Hapus border input */
        box-shadow: none; /* Hapus bayangan input */
    }

    .input-group button {
        background-color: #007bff; /* Warna latar belakang tombol */
        border: none; /* Hapus border tombol */
        color: white;
    }

    .input-group button:hover {
        background-color: #0056b3; /* Warna latar belakang tombol saat dihover */
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-title {
        margin-bottom: 1rem;
    }
</style>

<section class="gradient-bg py-5">
    <div class="container-fluid p-4 d-flex align-items-center justify-content-between">
        <a href="javascript:history.back()" class="btn back-button">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="container text-center">
      <h4>Repository Link Dokumen wh</h4>
    </div>
</section>

<section style="margin-top: 0.25rem;"> <!-- Mengurangi margin-top -->
    <div class="container">
        <div class="row align-items-center justify-content-end"> <!-- Menggunakan justify-content-end untuk memulai item dari kanan -->
            <div class="col-auto"> <!-- Menggunakan class 'col-auto' untuk bagian search -->
                <form action="{{ route('linkwh.showlinkwh') }}" method="GET" class="flex-grow-4">
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
        @foreach($linkwh as $repo)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-dark">
                        {{ $repo->judullinkwh }}
                    </h5>
                    <p class="card-text">
                        <a href="{{ $repo->linkdrivewh }}" target="_blank">{{ $repo->linkdrivewh }}</a>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
{{ $linkwh->links() }}
</section>
@endsection
