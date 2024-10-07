@extends('layouts.layoutsadmin')

@section('content')
<div class="container">
    <h2 style="margin-top: 100px;">Edit Document</h2>

    <form action="{{ route('admin.ip.materi.update', $document->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Indicate that this is a PUT request for updating -->

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $document->title) }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <!-- Display current image if exists -->
            @if($document->image)
                <img src="{{ asset('storage/icon/' . $document->image) }}" alt="Current Image" style="width: 100px; margin-top: 10px;">
            @endif
            <small class="text-muted">Leave blank to keep the current image.</small>
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Link document</label>
            <input type="url" class="form-control" id="link" name="link" value="{{ old('link', $document->link) }}" required>
            @error('link')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Document</button>
    </form>
</div>
@endsection