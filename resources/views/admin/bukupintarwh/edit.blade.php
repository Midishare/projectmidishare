@extends('layouts.layoutsadmin')

@section('content')
    <div class="container">
        <h2 style="margin-top: 100px;">Edit Slide</h2>

        <form action="{{ route('admin.bukupintarwh.materi.update', $materiDokumen->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $materiDokumen->title }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Sekarang</label>
                <div class="image-gallery">
                    @if ($materiDokumen && is_string($materiDokumen->file_paths))
                        @foreach (json_decode($materiDokumen->file_paths) as $path)
                            <img src="{{ asset($path) }}" width="100" alt="Image">
                        @endforeach
                    @elseif ($materiDokumen && is_array($materiDokumen->file_paths))
                        @foreach ($materiDokumen->file_paths as $path)
                            <img src="{{ asset($path) }}" width="100" alt="Image">
                        @endforeach
                    @endif
                </div>
            </div>


            <div class="mb-3">
                <label for="files" class="form-label">Upload Gambar Baru (Jika Ingin Mengganti)</label>
                <input type="file" class="form-control" id="files" name="files[]" multiple>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
