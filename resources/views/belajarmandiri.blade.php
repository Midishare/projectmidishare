@extends('layouts.layouts')

@section('content')
<style>
    .card-title a {
        text-decoration: none;
        color: #333;
    }

    .card-title a:hover {
        text-decoration: underline;
    }

    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .search-bar {
        margin-top: 1rem;
    }

    .search-bar input {
        border-radius: 20px 0 0 20px;
    }

    .search-bar button {
        border-radius: 0 20px 20px 0;
    }

    .container h4 {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
        border-radius: 10px 10px 0 0;
    }

    @media (max-width: 768px) {
        .container {
            margin-left: 0;
        }

        .card-img-top {
            height: 150px;
        }
    }
</style>

<section style="margin-top: 110px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h4>Belajar Mandiri</h4>
            </div>
            <div class="col-auto">
                <form action="{{ route('belajarmandiri.show') }}" method="GET" class="search-bar">
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
    <div class="container mt-4">
        <div class="row">
            @foreach($mandiri as $item)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('storage/icon/' . $item->gambarmandiri) }}" alt="Gambar Belajar Mandiri">
                    <div class="card-body">
                        <h5 class="card-title text-dark">
                            <a href="{{ $item->link }}" target="_blank">{{ $item->judul }}</a>
                        </h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row mt-4">
            <div class="col-md-12 d-flex justify-content-center">
                {{ $mandiri->links() }} <!-- Menggunakan links() untuk menampilkan pagination -->
            </div>
        </div>
    </div>
</section>
@endsection
