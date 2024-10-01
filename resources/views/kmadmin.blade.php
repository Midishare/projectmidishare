@extends('layouts.layoutsadmin')

@section('content')

<style>
    /* Animasi untuk hover */
    .card:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Efek hover untuk tombol */
    .btn-secondary:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }

    /* Menggunakan font Poppins */
    .card-title {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 1.5rem; /* Ukuran teks yang lebih besar */
        text-transform: uppercase; /* Mengubah ke huruf besar */
        letter-spacing: 1px; /* Menambahkan jarak antar huruf */
        color: #333; /* Warna teks yang lebih terang */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); /* Efek bayangan teks */
    }

    .btn-secondary {
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
    }

    /* Mengurangi ukuran tulisan Repository */
    .display-4 {
        font-size: 2rem; /* Mengurangi ukuran tulisan Repository */
    }
</style>

<section class="gradient-bg py-1">
    <div class="container-fluid p-5 text-center mt-4">
        {{-- <a class="btn btn-primary me-3 back-button" href="javascript:history.back()">Back</a> --}}
        <h2 class="display-4 mt-3">Repository</h2>
    </div>
</section>
<section class="py-2">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
            <div class="col">
                <div class="card h-100 p-3">
                    <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150" src="{{ asset('icon/ms5.png') }}" alt="People Development Manager">
                    <div class="card-body">
                        <h4 class="card-title text-center">People Development Manager</h4>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a class="btn btn-secondary" href="/materiadmin">View details &raquo;</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 p-3">
                    <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150" src="{{ asset('icon/ms2.png') }}" alt="Operation General Manager">
                    <div class="card-body">
                        <h4 class="card-title text-center">Operation General Manager</h4>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a class="btn btn-secondary" href="/materiadminmodogm">View details &raquo;</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 p-3">
                    <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150" src="{{ asset('icon/ms10.png') }}" alt="Ware House">
                    <div class="card-body">
                        <h4 class="card-title text-center">Ware House</h4>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a class="btn btn-secondary" href="/materiadminmodwh">View details &raquo;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div style="height: 80px;"></div>
@endsection