@extends('layouts.layoutsadmin')

@section('content')
    <div class="container">
        <h2 style="margin-top: 100px;">Add New Document</h2>

        <form action="{{ route('admin.copfresh.materi.store') }}" method="POST" enctype="multipart/form-data">
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
            {{-- <div class="form-group mb-3">
                <label for="category">Category</label>
                <select name="category" class="form-control" id="category" required>
                    <option value="">-- Semua Category --</option>
                    <option value="Ambon" {{ old('category') == 'Ambon' ? 'selected' : '' }}>Ambon</option>
                    <option value="Bekasi" {{ old('category') == 'Bekasi' ? 'selected' : '' }}>Bekasi</option>
                    <option value="Bitung" {{ old('category') == 'Bitung' ? 'selected' : '' }}>Bitung</option>
                    <option value="Boyolali" {{ old('category') == 'Boyolali' ? 'selected' : '' }}>Boyolali</option>
                    <option value="Head Office" {{ old('category') == 'Head Office' ? 'selected' : '' }}>Head Office
                    </option>
                    <option value="Kendari" {{ old('category') == 'Kendari' ? 'selected' : '' }}>Kendari</option>
                    <option value="Makasar" {{ old('category') == 'Makasar' ? 'selected' : '' }}>Makasar</option>
                    <option value="Manado" {{ old('category') == 'Manado' ? 'selected' : '' }}>Manado</option>
                    <option value="Medan" {{ old('category') == 'Medan' ? 'selected' : '' }}>Medan</option>
                    <option value="Palu" {{ old('category') == 'Palu' ? 'selected' : '' }}>Palu</option>
                    <option value="Pasuruan" {{ old('category') == 'Pasuruan' ? 'selected' : '' }}>Pasuruan</option>
                    <option value="Samarinda" {{ old('category') == 'Samarinda' ? 'selected' : '' }}>Samarinda</option>
                </select>
            </div> --}}

            <button type="submit" class="btn btn-primary">Create Document</button>
        </form>
    </div>
@endsection
