@extends('layouts.layouts')

@section('content')
<div class="container text-center" style="margin-top: 150px;">
    <h1>Livestream Event</h1>
    <div style="position: relative; width: 1270px; height: 315px;">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/JenRShOLLdI?autoplay=1&mute=1" title="YouTube livestream" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: transparent;"></div>
    </div>
</div>
@endsection
