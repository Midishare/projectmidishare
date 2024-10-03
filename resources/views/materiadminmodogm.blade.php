@extends('layouts.layoutsadmin')

@section('content')

<style>
    /* Animasi untuk fadeIn */
    .animated {
        animation-duration: 0.5s;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 2; }
    }

    /* Efek hover untuk card */
    .card:hover {
        transform: translateY(-5px); /* Mengangkat card sedikit saat dihover */
        transition: transform 0.3s ease;
    }

    /* Efek hover untuk tombol */
    .btn-secondary:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }

    /* Penempatan tombol back di atas dan di sebelah kiri judul */
    .back-button {
        position: absolute;
        top: 90px; /* Penyesuaian posisi kebawah */
        left: 20px;
    }

    /* Ukuran judul yang diperkecil */
    .judul {
        font-size: 2rem;
    }

    /* Ubah warna teks menjadi gelap untuk kontras lebih baik di atas latar belakang putih */
    .text-dark {
        color: #343a40; /* Warna teks gelap */
    }
</style>

<div class="container-fluid p-3 bg-white text-dark text-center mt-4 animated fadeIn">
    <!-- Konten di dalam container fluid -->
</div>

<section class="gradient-bg py-1">
    <div class="container-fluid p-4 text-center mt-4">
        {{-- <a href="javascript:history.back()" class="btn back-button" style="margin-right: 20px;"> <!-- Ubah nilai margin-right sesuai keinginan -->
            <i class="bi bi-arrow-left"></i> Kembali
        </a> --}}
        <h2>Materi Pembelajaran Operation General Manager</h2>
    </div>
</section>
<div class="container text-center mt-4 animated fadeIn">
    <div class="row row-cols-1 row-cols-md-2 g-8 justify-content-center align-items-center">
        <div class="col">
            <div class="card h-100">
                <img class="bd-placeholder-img rounded-circle mx-auto" width="180" height="180" src="{{ asset('icon/dokumen.png') }}" alt="Operation General Manager">
                <div class="card-body">
                    <h2 class="card-title">Materi Dokumen</h2>
                    {{-- <p class="card-text">Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p> --}}
                </div>
                <div class="card-footer">
                    <a class="btn btn-secondary"  href="materilinkogm">View details &raquo;</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <img class="bd-placeholder-img rounded-circle mx-auto" width="180" height="180" src="{{ asset('icon/video player.png') }}" alt="Operation General Manager">
                <div class="card-body">
                    <h2 class="card-title">Video</h2>
                    {{-- <p class="card-text">Another exciting bit of representative placeholder content. This time, we've moved on to the second column.</p> --}}
                </div>
                <div class="card-footer">
                    <a class="btn btn-secondary" href="showvideomodogm">View details &raquo;</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="height: 60px;"></div>
@endsection
