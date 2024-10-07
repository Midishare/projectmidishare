@extends('layouts.layoutsadmin')

@section('content')
<div class="container">
    <h2 style="margin-top: 100px;">Add New Video</h2>
    
    <form action="{{ route('admin.video.update', $video->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Indicate that this is a PUT request for updating -->

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $video->title) }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Video Link</label>
            <input type="url" class="form-control" id="link" name="video_link" value="{{ old('link', $video->video_link) }}" required>
            @error('video_link')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Video</button>
    </form>
</div>
@endsection
