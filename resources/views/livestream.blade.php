@extends('layouts.layouts')

@section('content')
<div class="container text-center" style="margin-top: 150px;">
    <h1>Livestream Event</h1>

    @if($livestream && $livestream->url)
        <div style="position: relative; width: 1270px; height: 315px;">
            <iframe width="560" height="315" src="{{ $livestream->url }}?autoplay=1&mute=1" 
                    title="YouTube livestream" frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe>
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: transparent;"></div>
        </div>
    @else
        <p>No livestream available at the moment.</p>
    @endif
</div>
@endsection
