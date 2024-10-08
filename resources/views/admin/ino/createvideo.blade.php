@extends('layouts.layoutsadmin')

@section('content')
<div class="container">
    <h2 style="margin-top: 100px;">Add New Video</h2>
    <form action="{{ route('admin.ino.video.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="link">Video Link</label>
            <input type="url" class="form-control" id="link" name="video_link" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Video</button>
    </form>
</div>
@endsection