@extends('layouts.layoutsadmin')

@section('content')
<div class="container">
    <h1>Edit Event</h1>
    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $event->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" required>{{ $event->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Gambar Event</label>
            <input type="file" name="image" id="image" class="form-control">
            @if($event->image)
                <img src="{{ asset('storage/event_images/' . $event->image) }}" alt="Event Image" style="max-width: 100px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
</div>
@endsection
