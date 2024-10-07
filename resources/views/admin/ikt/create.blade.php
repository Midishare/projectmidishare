@extends('layouts.layoutsadmin')

@section('content')
<div class="container">
    <h2 style="margin-top: 100px;">Add New Document</h2>

    <form action="{{ route('admin.ikt.materi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Link Dokumen</label>
            <input type="url" class="form-control" id="link" name="link" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Document</button>
    </form>
</div>
@endsection
