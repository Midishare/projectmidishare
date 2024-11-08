@extends('layouts.layoutsadmin')

@section('content')
<div class="container">
    <h2 style="margin-top: 100px;">Add New Video</h2>
    
    <form action="{{ route('admin.ino.video.update', $video->id) }}" method="POST">
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

        <div class="form-group mb-3">
            <label for="category">Category</label>
            <select name="category" class="form-control" id="category" required>
                <option value="">-- Semua Category --</option>
                <option value="Ambon" {{ $video->category == 'Ambon' ? 'selected' : '' }}>Ambon</option>
                <option value="Business Controlling" {{ $video->category == 'Business Controlling' ? 'selected' : '' }}>Business Controlling</option>
                <option value="Bekasi" {{ $video->category == 'Bekasi' ? 'selected' : '' }}>Bekasi</option>
                <option value="Bitung" {{ $video->category == 'Bitung' ? 'selected' : '' }}>Bitung</option>
                <option value="Boyolali" {{ $video->category == 'Boyolali' ? 'selected' : '' }}>Boyolali</option>
                <option value="Head Office" {{ $video->category == 'Head Office' ? 'selected' : '' }}>Head Office</option>
                <option value="Kendari" {{ $video->category == 'Kendari' ? 'selected' : '' }}>Kendari</option>
                <option value="Makasar" {{ $video->category == 'Makasar' ? 'selected' : '' }}>Makasar</option>
                <option value="Manado" {{ $video->category == 'Manado' ? 'selected' : '' }}>Manado</option>
                <option value="Medan" {{ $video->category == 'Medan' ? 'selected' : '' }}>Medan</option>
                <option value="Palu" {{ $video->category == 'Palu' ? 'selected' : '' }}>Palu</option>
                <option value="Samarinda" {{ $video->category == 'Samarinda' ? 'selected' : '' }}>Samarinda</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Video</button>
    </form>
</div>
@endsection
