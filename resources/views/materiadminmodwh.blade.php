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

    /* Warna teks dan latar belakang */
    body {
        color: #333; /* Warna teks */
        background-color: #f8f9fa; /* Warna latar belakang */
    }

    /* Gradasi warna latar belakang */
    .gradient-bg {
        background: linear-gradient(to right, #ffffff, #f2f6fa);
    }

    /* Gaya untuk tombol back */
    .back-button {
        position: absolute;
        top: 80px; /* Menyesuaikan tinggi dari bagian atas */
        left: 20px;
        z-index: 999;
    }

    /* Ukuran judul yang diperkecil */
    .judul {
        font-size: 2rem;
    }
</style>

<section class="gradient-bg py-1">
    <div class="container-fluid p-5 text-center mt-4">
        {{-- <a href="javascript:history.back()" class="btn back-button" style="margin-right: 20px;"> <!-- Ubah nilai margin-right sesuai keinginan -->
            <i class="bi bi-arrow-left"></i> Kembali
        </a> --}}
        <h2>Materi Pembelajaran Warehouse</h2>
    </div>
</section>
    <div class="container text-center mt-5">
        <div class="row row-cols-1 row-cols-md-2 g-5 justify-content-center">
            <div class="col">
                <div class="card h-100 p-4">
                    <img class="bd-placeholder-img rounded-circle mx-auto" width="180" height="180" src="{{ asset('icon/dokumen.png') }}" alt="Operation General Manager">
                    <div class="card-body">
                        <h2 class="card-title">Materi Dokumen</h2>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-secondary" href="/materilinkwh">View details &raquo;</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 p-4">
                    <img class="bd-placeholder-img rounded-circle mx-auto" width="180" height="180" src="{{ asset('icon/video player.png') }}" alt="Operation General Manager">
                    <div class="card-body">
                        <h2 class="card-title">Video</h2>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-secondary" href="{{ route('videowh.show_by_adminvidwhshow') }}">View details &raquo;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div style="height: 60px;"></div>
@endsection
