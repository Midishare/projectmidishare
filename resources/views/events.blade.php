@extends('layouts.layouts')

@section('content')
<section style="margin-top: 100px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h4>Events</h4>
            </div>
            <div class="col-auto">
                <form action="{{ route('events.show') }}" method="GET">
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
            @foreach($events as $event)
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                <div class="card shadow-sm h-100 w-100 p-1">
                    <img class="card-img-top" src="{{ asset('storage/event_images/' . $event->image) }}" alt="Event image" style="height: 200px; width: auto; object-fit: cover;">
                    <div class="card-body d-flex flex-row justify-content-between">
                        <h5 class="">
                            <a href="{{ route('events.detail', ['id' => $event->id]) }}" class="news-title-link">{{ $event->title }}</a>
                        </h5>
                    </div>
                    <p class="card-text ms-auto"><small class="text-muted">{{ \Carbon\Carbon::parse($event->created_at)->format('d M Y') }}</small></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $events->appends(request()->input())->links() }}
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

    .news-title-link {
        text-decoration: none;
        color: black;
        transition: color 0.3s ease; 
    }

    .news-title-link:hover {
        color: #007bff; 
    }
</style>
