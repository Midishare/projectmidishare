@extends('layouts.layouts')

@section('content')
<section style="margin-top: 100px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h4>News</h4>
            </div>
            <div class="col-auto">
                <form action="{{ route('berita.show') }}" method="GET">
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
            @foreach($news as $berita)
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                <div class="card shadow-sm h-100 w-100 p-1">
                    <img class="card-img-top" src="{{ asset('storage/icon/' . $berita->gambar) }}" alt="Card image cap" style="height: 200px; width: auto; object-fit: cover;">
                    <div class="card-body d-flex flex-row justify-content-between">
                        <h5 class="">
                            <a href="{{ route('berita.detail', ['id' => $berita->id]) }}"  class="news-title-link">{{ $berita->judul }}</a>
                        </h5>
                    </div>
                    <p class="card-text ms-auto"><small class="text-muted">{{ \Carbon\Carbon::parse($berita->published_at)->format('d M Y') }}</small></p>
                    {{-- <div class="p-3 text-Secondary">
                        <p class="card-text ">{{ \Illuminate\Support\Str::limit(strip_tags($berita->deskripsi), 100, '...') }}</p>
                        <a href="{{ route('berita.detail', ['id' => $berita->id]) }}" class="mt-auto">Read More</a>
                    </div> --}}
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
/* Custom CSS for card hover effect */
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

</style>


