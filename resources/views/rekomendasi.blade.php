<!-- resources/views/rekomendasi/show.blade.php -->

@extends('layouts.layouts')

@section('content')
<div class="container">
    <h2>Rekomendasi Belajar Anda</h2>

    @if ($rekomendasi)
        <p>{{ $rekomendasi->rekomendasi }}</p>
    @else
        <p>Belum ada rekomendasi belajar untuk Anda.</p>
    @endif
</div>
@endsection
