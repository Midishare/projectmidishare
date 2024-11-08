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
        <div class="form-group mb-3">
            <label for="category">Category</label>
            <select name="category" class="form-control" id="category" required>
                <option value="">-- Semua Category --</option>
                <option value="Ambon">Ambon</option>
                <option value="Bekasi">Bekasi</option>
                <option value="Bitung">Bitung</option>
                <option value="Boyolali">Boyolali</option>
                <option value="Head Office">Head Office</option>
                <option value="Kendari">Kendari</option>
                <option value="Makasar">Makasar</option>
                <option value="Manado">Manado</option>
                <option value="Medan">Medan</option>
                <option value="Palu">Palu</option>
                <option value="Pasuruan">Pasuruan</option>
                <option value="Samarinda">Samarinda</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Video</button>
    </form>
</div>
@endsection