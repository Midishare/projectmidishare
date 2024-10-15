@extends('layouts.layoutsadmin')

@section('content')

<section>
<div class="container" style="margin-top: 7rem;">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12 bg-white p-4">
            <h2 class="text-center">Edit Artikel</h2>
            <form method="post" action="{{ route('berita.edit_process') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$news->id}}" name="id">
                <div class="form-group">
                    <label>Judul News</label>
                    <input type="text" class="form-control" value="{{$news->judul}}" name="judul" placeholder="Judul Berita">
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="15" style="text-align: justify;">{{$news->deskripsi}}</textarea>
                </div>
                <div class="form-group">
                    <label for="published_at">Publish Date</label>
                    <input type="date" class="form-control" id="published_at" name="published_at" value="{{ $news->published_at->format('Y-m-d') }}">
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" class="form-control" id="gambar" name="gambar">
                </div>               
                <div class="form-group" style="margin-top: 2rem;">
                    <input type="submit" class="btn btn-primary" value="Edit">
                </div>
            </form>
        </div>
    </div>
</div>
</section>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script> --}}
<script>
    $(document).ready(function() {
        $('#deskripsi').summernote({
            height: 300,  // Summernote height
            placeholder: 'Tulis isi artikel di sini...',  // Placeholder text
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['forecolor', 'backcolor']],
                ['para', ['ul', 'ol', 'paragraph', 'height']], // Add 'height' for line height setting
                ['insert', ['link']],
                ['align', ['alignLeft', 'alignCenter', 'alignRight', 'alignJustify']], // Add align buttons
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
@endsection
