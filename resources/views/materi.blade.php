@extends('layouts.layouts')

@section('content')

<section>
<style>
    /* CSS untuk kustomisasi footer */
    .footer {
        background-color: #333; /* Warna latar belakang footer */
        color: #fff; /* Warna teks footer */
        padding: 20px 0; /* Padding pada footer */
    }

    /* CSS untuk menyesuaikan margin atas */
    .mt-4 {
        margin-top: 20px; /* Sesuaikan margin atas sesuai kebutuhan */
    }

    /* Style untuk efek hover pada card */
    .card:hover {
        transform: translateY(-5px); /* Menggeser card ke atas saat hover */
        transition: transform 0.3s ease; /* Transisi halus saat hover */
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Efek bayangan saat hover */
    }

    /* Style untuk judul card */
    .card-title {
        font-size: 24px; /* Ukuran font judul */
    }

    /* Style untuk teks pada card */
    .card-text {
        font-size: 16px; /* Ukuran font teks */
    }

    /* Style untuk tombol pada card */
    .btn-secondary {
        background-color: #333; /* Warna latar belakang tombol */
        border-color: #333; /* Warna border tombol */
        transition: background-color 0.3s ease; /* Transisi halus saat hover */
    }

    /* Style untuk tombol pada card saat hover */
    .btn-secondary:hover {
        background-color: #555; /* Warna latar belakang tombol saat hover */
        border-color: #555; /* Warna border tombol saat hover */
    }

    /* CSS untuk tombol kembali ke atas */
    #scroll-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
        width: 50px;
        height: 50px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #scroll-to-top i {
        line-height: 50px;
        text-align: center;
    }

    #scroll-to-top:hover {
        background-color: #555;
    }
</style>

<div class="row align-items-center">
    <section class="gradient-bg py-5">
        <div class="container-fluid p-4 d-flex align-items-center justify-content-between">
          <a href="javascript:history.back()" class="btn back-button">
            <i class="bi bi-arrow-left"></i> Kembali
          </a>
          <h2 class="mx-auto" style="margin-top: 20px;">Materi Pembelajaran People Development Manager</h2>
          <div></div> <!-- Placeholder div to balance the flex container -->
        </div>
      </section>

<div class="container text-center mt-4">

    <div class="row row-cols-1 row-cols-md-2 g-4 justify-content-center">
        <div class="col">
            <div class="card h-120">
                <img class="bd-placeholder-img rounded-circle mx-auto" width="180" height="180" src="{{ asset('icon/dokumen.png') }}" alt="Operation General Manager">
                <div class="card-body">
                    <h2 class="card-title">Materi Dokumen</h2>
                </div>
                <div class="card-footer">
                    <a class="btn btn-secondary"  href="/repositorylinkmod">View details &raquo;</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-120">
                <img class="bd-placeholder-img rounded-circle mx-auto" width="180" height="180" src="{{ asset('icon/video player.png') }}" alt="Operation General Manager">
                <div class="card-body">
                    <h2 class="card-title">Video</h2>
                </div>
                <div class="card-footer">
                    <a class="btn btn-secondary" href="{{ route('video.showvideomod') }}">View details &raquo;</a>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<div style="height: 60px;"></div>
@endsection
