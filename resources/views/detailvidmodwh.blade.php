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
            <a href="/modwh" class="btn" style="margin-top: 5rem; margin-right:31rem;">
                <i class="bi bi-arrow-left"></i> Kembali
            </a> 
        </div>     
        @if($videowh)
            <div class="content">
                <h2 style="margin-top: 2rem;">{{ $videowh->judulvidwh }}</h2>
                <h2 style="margin-top: 2rem;">{{ $videowh->dokumenvideowh }}</h2>
            </div>
        @else
            <div class="alert alert-danger">Data tidak ditemukan.</div>
        @endif
    </div>
</div>
@endsection
