@extends('layouts.layoutsadmin')

@section('content')

<div class="container" style="margin-top: 7rem;">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12 bg-white p-4">
            <h2 class="text-center">Edit Belajar Mandiri</h2>
            <form method="post" action="/editmandiri_process" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$mandiri->id}}" name="id">
                <div class="form-group">
                    <label>Judul News</label>
                    <input type="text" class="form-control" value="{{$mandiri->judul}}" name="judul" placeholder="Judul Berita">
                </div>
                <div class="form-group">
                    <label>Link</label>
                    <input name="link" class="form-control" rows="15" style="text-align: justify;" value="{{$mandiri->link}}">
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar belajar Mandiri</label>
                    <input type="file" class="form-control" id="gambarmandiri" name="gambar">
                    {{-- @if($news->gambar)
                        <img src="{{ asset('storage/icon/') }}" alt="Gambar Berita" style="max-width: 100px;">
                    @else
                        <p>Gambar tidak tersedia</p>
                    @endif --}}
                </div>               
                <div class="form-group" style="margin-top: 2rem;">
                    <input type="submit" class="btn btn-primary" value="Edit">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection