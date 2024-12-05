@extends('layouts.layouts')

@section('content')
    <section style="margin-top: 100px;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <h4>Berita Terbaru</h4>
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
                    <h4>Berita</h4>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container" style="margin-top: 2rem;">
            <div class="wrap">
                @foreach ($news as $berita)
                    <div class="card m-2">
                        <div class="poster">
                            <img src="{{ asset('storage/icon/' . $berita->gambar) }}" alt="Card image cap">
                        </div>
                        <div class="details">
                            <a href="{{ route('berita.detail', ['id' => $berita->id]) }}"
                                class="text-white text-decoration-none">
                                <h3>{{ \Illuminate\Support\Str::limit($berita->judul, 20, '...') }}</h3>
                                <p>{{ \Carbon\Carbon::parse($berita->published_at)->format('d M Y') }}</p>
                            </a>
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
    .card {

        position: relative;
        width: 300px;
        height: 450px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
    }

    .card .poster {

        position: relative;
        overflow: hidden;
    }

    .card .poster::before {

        content: '';
        position: absolute;
        bottom: -180px;
        width: 100%;
        height: 100%;
        background: linear-gradient(0deg, #272727 20%,
                transparent);
        transition: 0.5s;
        z-index: 10;
    }

    .card:hover .poster::before {
        bottom: 0px;
    }

    .card .poster img {
        width: 320px;
        height: 450px;
        transition: 0.5s;
        object-fit: cover;
    }

    .card:hover .poster img {
        transform: translateY(-50px);
        filter: blur(5px);
    }

    .card .details {
        position: absolute;
        bottom: 0;
        left: 0;
        padding: 20px;
        width: 100%;
        z-index: 11;
        transition: 0.5s;
    }

    .card:hover .details {
        bottom: 40px;
    }

    .card .details a h3 {
        color: #fff;
        text-decoration: none;
    }

    .wrap {
        display: flex;
        flex-wrap: wrap;
    }

    @media (max-width: 768px) {
        .wrap {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    }






    /* .card:hover {
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
            display: block ;
            padding: 10px;
        }

        .carousel-caption h5 {
            font-size: 1rem;
        }

        .carousel-caption p {
            font-size: 0.8rem;
        }
    } */
</style>
