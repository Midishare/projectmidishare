@extends('layouts.layoutsadmin')

@section('content')
    <div class="container" style="margin-top: 100px;">
        <h2>Edit Video</h2>

        <form action="{{ route('admin.videobukupintarwh.video.update', $videobukupintarwh->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ $videobukupintarwh->title }}" required>
            </div>
            <div class="form-group">
                <label>Video Link</label>
                <input type="url" name="video_link" class="form-control" value="{{ $videobukupintarwh->video_link }}"
                    required>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control">
                <img src="{{ Storage::url($videobukupintarwh->image_path) }}" width="100">
            </div>
            <button type="submit" class="btn btn-primary">Update Video</button>
        </form>
    </div>
@endsection