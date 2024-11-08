@extends('layouts.layoutsadmin')

@section('content')
<div class="container">
    <h2 style="margin-top: 100px;">Tambah Slide Baru</h2>

    <form action="{{ route('admin.bukupintarwh.materi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="files" class="form-label">Upload Gambar</label>
            <input type="file" class="form-control" id="files" name="files[]" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
    
</div>
@endsection
