@extends('layouts.layoutsadmin')

@section('content')

<section>
<div class="container" style="margin-top: 7rem;">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12 bg-white p-4">
            <h2 class="text-center">Edit Event</h2>
            <form method="post" action="{{ route('events.update', $event->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Judul Event</label>
                    <input type="text" class="form-control" value="{{ $event->title }}" name="title" placeholder="Judul Event" required>
                </div>
                
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" rows="15" style="text-align: justify;">{{ $event->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="published_at">Publish Date</label>
                    <input type="date" class="form-control" id="published_at" name="published_at" value="{{ $event->created_at->format('Y-m-d') }}">
                </div>

                <div class="form-group">
                    <label for="image">Gambar</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($event->image)
                        <img src="{{ asset('storage/event_images/' . $event->image) }}" alt="Event Image" style="max-width: 100px; margin-top: 10px;">
                    @endif
                </div>
                
                <div class="form-group" style="margin-top: 2rem;">
                    <input type="submit" class="btn btn-primary" value="Edit">
                </div>
            </form>
        </div>
    </div>
</div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#description').summernote({
            height: 300,  // Set height for Summernote editor
            placeholder: 'Tulis deskripsi event di sini...',  // Placeholder for the description field
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['forecolor', 'backcolor']],
                ['para', ['ul', 'ol', 'paragraph', 'height']],
                ['align', ['alignLeft', 'alignCenter', 'alignRight', 'alignJustify']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>

@endsection
