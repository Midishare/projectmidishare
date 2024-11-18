@extends('layouts.layoutsadmin')

@section('content')
    <div class="container">
        <h2 style="margin-top: 100px;">Edit Document</h2>

        <form action="{{ route('admin.copdevprog.materi.update', $dokumen->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $dokumen->title) }}" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                @if ($dokumen->image)
                    <img src="{{ asset('storage/icon/' . $dokumen->image) }}" alt="Current Image"
                        style="width: 100px; margin-top: 10px;">
                @endif
                <small class="text-muted">Leave blank to keep the current image.</small>
            </div>

            <div class="mb-3">
                <label for="link" class="form-label">Link Dokumen</label>
                <input type="url" class="form-control" id="link" name="link"
                    value="{{ old('link', $dokumen->link) }}" required>
                @error('link')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- <div class="mb-3">
                <label for="category">Category</label>
                <select name="category" class="form-control" id="category" required>
                    <option value="">-- Semua category --</option>
                    <option value="Ambon" {{ $dokumen->category == 'Ambon' ? 'selected' : '' }}>Ambon</option>
                    <option value="Bekasi" {{ $dokumen->category == 'Bekasi' ? 'selected' : '' }}>Bekasi</option>
                    <option value="Bitung" {{ $dokumen->category == 'Bitung' ? 'selected' : '' }}>Bitung</option>
                    <option value="Boyolali" {{ $dokumen->category == 'Boyolali' ? 'selected' : '' }}>Boyolali</option>
                    <option value="Head Office" {{ $dokumen->category == 'Head Office' ? 'selected' : '' }}>Head Office
                    </option>
                    <option value="Kendari" {{ $dokumen->category == 'Kendari' ? 'selected' : '' }}>Kendari</option>
                    <option value="Makasar" {{ $dokumen->category == 'Makasar' ? 'selected' : '' }}>Makasar</option>
                    <option value="Manado" {{ $dokumen->category == 'Manado' ? 'selected' : '' }}>Manado</option>
                    <option value="Medan" {{ $dokumen->category == 'Medan' ? 'selected' : '' }}>Medan</option>
                    <option value="Palu" {{ $dokumen->category == 'Palu' ? 'selected' : '' }}>Palu</option>
                    <option value="Pasuruan" {{ $dokumen->category == 'Pasuruan' ? 'selected' : '' }}>Pasuruan</option>
                    <option value="Samarinda" {{ $dokumen->category == 'Samarinda' ? 'selected' : '' }}>Samarinda</option>
                </select>
            </div> --}}

            <button type="submit" class="btn btn-primary">Update Document</button>
        </form>
    </div>
@endsection
