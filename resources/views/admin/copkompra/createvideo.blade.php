@extends('layouts.layoutsadmin')

@section('content')
    <style>
        .container {
            margin-top: 100px;
        }
    </style>
    <div class="container">
        <h2>Add New Video</h2>

        <form action="{{ route('admin.videocopkompra.video.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Video Link</label>
                <input type="url" name="video_link" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Video</button>
        </form>
    </div>
@endsection
