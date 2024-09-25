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
    }

    .description {
        text-align: justify;
    }
</style>

<div class="center-content" style="margin-top: 3rem;">
    <div class="content-wrapper">  
        <div>
            <a href="/modkm" class="btn" style="margin-top: 5rem; margin-right:31rem;">
                <i class="bi bi-arrow-left"></i> Kembali
            </a> 
        </div>     
        @if($videomod)
            <div class="content">
                <h2 style="margin-top: 2rem;">{{ $videomod->judulvidmod }}</h2>
                <h2 style="margin-top: 2rem;">{{ $videomod->dokumenvideo }}</h2>
                {{-- <img class="card-img-top" src="{{ asset('storage/icon/' . $mandiri->dokume) }}" alt="Card image cap" style="margin-top: 1rem;"> --}}
                {{-- <p class="description mt-3">{{ $mandiri->dokumenfile }}</p> --}}
            </div>
        @else
            <div class="alert alert-danger">Data tidak ditemukan.</div>
        @endif
    </div>
</div>
@endsection
