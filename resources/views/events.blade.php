@extends('layouts.layouts')

@section('content')
<div class="container">
    <h1 style="margin-top: 1000px">Events</h1>

    <div class="row">
        <h1></h1>
        @foreach ($events as $event)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if ($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ $event->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
