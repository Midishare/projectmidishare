@extends('layouts.layouts')

@section('content')

<section class="gradient-bg py-5">
    <div class="container-fluid p-4 d-flex align-items-center justify-content-between">
        <a href="javascript:history.back()" class="btn back-button">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="container text-center" style="margin-top: 0.2rem;"> <!-- Menyesuaikan margin-top pada judul -->
        <h4 class="mb-0">Repository Knowledge</h4>
    </div>
</section>

<section class="mt" style="margin-top: 0.2rem; margin-bottom: 0.5rem;"> <!-- Menyesuaikan margin-top pada bagian pencarian -->
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <!-- Placeholder div to balance the flex container -->
            </div>
            <div class="col-auto">
                <form action="{{ route('knowledge.showkm') }}" method="GET">
                    <div class="input-group" style="margin-top: 0.1rem;"> <!-- Menyesuaikan margin-top pada bagian pencarian -->
                        <input type="text" name="search" class="form-control" aria-describedby="searchHelpInline" placeholder="Search...">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="my-5">
    <div class="container">
        <div class="row">
            @foreach($repositorykm as $repo)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img class="card-img-top" src="{{ asset('storage/gambar/' . $repo->gambar) }}" alt="Card image cap">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-dark">
                            <a href="{{ asset('storage/dokumen/' . $repo->dokumenfile) }}" target="_blank">{{ $repo->judul }}</a>
                        </h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Pagination -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                {{ $repositorykm->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</section>

<!-- Gaya CSS -->
<style>
    .card-title a {
        color: black; /* Mengubah warna teks judul menjadi hitam */
        text-decoration: none; /* Menghilangkan dekorasi hyperlink */
    }

    .card-title a:hover {
        text-decoration: underline; /* Menampilkan garis bawah saat mengarahkan kursor */
    }

    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px); /* Menambahkan efek hover */
    }

    .back-button {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Penyesuaian tata letak judul */
    h4 {
        margin-top: 0.2rem; /* Menambahkan margin-top yang lebih kecil pada judul */
        margin-bottom: 0; /* Menghilangkan margin bawah untuk rapi */
    }
</style>
@endsection
