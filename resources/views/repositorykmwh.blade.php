@extends('layouts.layouts')

@section('content')
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

<section class="gradient-bg py-5">
    <div class="container-fluid p-4 d-flex align-items-center justify-content-between">
        <a href="javascript:history.back()" class="btn back-button">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="container text-center">
          <h2 >Repository Knowledge Warehouse</h3>
          </div> <!-- Placeholder div to balance the flex container -->
        </div>
      </section>


  <section style="margin-top: 0.25rem;"> <!-- Mengurangi margin-top -->
    <div class="container">
        <div class="row align-items-center justify-content-end"> <!-- Menggunakan justify-content-end untuk memulai item dari kanan -->
            <div class="col-auto"> <!-- Menggunakan class 'col-auto' untuk bagian search -->
            <div class="col-auto">
                <form action="{{ route('knowledgewh.showkmwh') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" aria-describedby="searchHelpInline" placeholder="Search...">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container" style="margin-top: 2rem;">
        <div class="row">
            @foreach($repositorykmwh as $repo)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('storage/gambar/' . $repo->gambarrepowh) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title text-dark">
                            <a href="{{ asset('storage/dokumen/' . $repo->dokumenfilerepowh) }}" target="_blank">{{ $repo->judulrepowh }}</a>
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
                {{ $repositorykmwh->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</section>


@endsection
