@extends('layouts.layouts')

@section('content')
<style>
    .center-content {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 150px); 
    }

    .content-wrapper {
        max-width: 600px; 
        text-align: center; 
    }

    .content {
        margin-top: 2rem;
        margin-bottom: 2rem;
        text-align: justify;
    }

    /* .description {
        text-align: justify;
    } */

</style>
<div class="center-content" style="margin-top: 3rem;">
    <div class="content-wrapper">  
        <div>
            <a href="{{ route('events.show') }}" class="btn" style="margin-right:30rem;">
                <i class="bi bi-arrow-left"></i> Kembali
            </a> 
        </div>     
        @if($event)
            <h3 style="margin-top: 1rem;" style="text-align: center;"><strong>{{ $event->title }}</strong></h3>
            <div class="content">
                <img class="card-img-top" src="{{ asset('storage/event_images/' . $event->image) }}" alt="Card image cap" style="margin-top: 1rem;">
                <p class="description mt-3 ml-10">{!! $event->description !!}</p>
            </div>
        @else
            <div class="alert alert-danger">Data tidak ditemukan.</div>
        @endif
    </div>
</div>
@endsection
