@extends('layouts.layouts')

@section('content')
    <!-- Carousel Section -->
    <section style="margin-top: 100px;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <h4>Latest News</h4>
                </div>
                <div class="col-auto">
                    <form action="{{ route('berita.show') }}" method="GET">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" aria-describedby="searchHelpInline"
                                placeholder="Search...">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($news->take(5) as $key => $item)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/icon/' . $item->gambar) }}" class="d-block w-100"
                                alt="{{ $item->judul }}" style="height: 400px; object-fit: fill;">
                            <div class="carousel-caption d-md-block">
                                <h5>{{ \Illuminate\Support\Str::limit($item->judul, 20, '...') }}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>
    <section style="margin-top: 50px;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <h4>News</h4>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container" style="margin-top: 2rem;">
            <div class="row">
                @foreach ($news as $berita)
                    <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                        <div class="card shadow-sm h-100 w-100 p-1">
                            <img class="card-img-top card-img-headline" src="{{ asset('storage/icon/' . $berita->gambar) }}"
                                alt="Card image cap" style="height: 200px; width: auto; object-fit: cover;">
                            <div class="card-body d-flex flex-row justify-content-between">
                                <h5 class="">
                                    <a href="{{ route('berita.detail', ['id' => $berita->id]) }}" class="news-title-link">
                                        {{ \Illuminate\Support\Str::limit($berita->judul, 20, '...') }}
                                    </a>
                                </h5>
                            </div>
                            <p class="card-text ms-auto"><small
                                    class="text-muted">{{ \Carbon\Carbon::parse($berita->published_at)->format('d M Y') }}</small>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $news->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
    .card:hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .card-title a:hover {
        color: #007bff;
    }

    .news-title-link {
        text-decoration: none;
        color: black;
        transition: color 0.3s ease;
    }

    .news-title-link:hover {
        color: #007bff;
    }

    .carousel-item img {
        height: 400px;
        object-fit: cover;
    }

    .carousel-caption {
        background: rgba(0, 0, 0, 0.5);
        padding: 20px;
        border-radius: 5px;
    }

    @media (max-width: 768px) {
        .carousel-item img {
            height: 200px;
        }

        .carousel-caption {
            display: block !important;
            padding: 10px;
        }

        .carousel-caption h5 {
            font-size: 1rem;
        }

        .carousel-caption p {
            font-size: 0.8rem;
        }
    }
</style>
