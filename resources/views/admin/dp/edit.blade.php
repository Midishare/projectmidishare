@extends('layouts.layoutsadmin')

@section('content')
    <div class="container">
        <h2 style="margin-top: 100px;">Edit Document</h2>

        <form action="{{ route('admin.dp.materi.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data">
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

            <div class="form-group mb-3">
                <label for="category">Category</label>
                <select name="category" class="form-control" id="category" required>
                    <option value="">-- Category --</option>
                    <option value="Human Capital" {{ $dokumen->category == 'Human Capital' ? 'selected' : '' }}>Human
                        Capital</option>
                    <option value="Business Controlling"
                        {{ $dokumen->category == 'Business Controlling' ? 'selected' : '' }}>Business Controlling</option>
                    <option value="Corporate Audit" {{ $dokumen->category == 'Corporate Audit' ? 'selected' : '' }}>
                        Corporate Audit</option>
                    <option value="Finance" {{ $dokumen->category == 'Finance' ? 'selected' : '' }}>Finance</option>
                    <option value="IT" {{ $dokumen->category == 'IT' ? 'selected' : '' }}>IT</option>
                    <option value="Merchandising" {{ $dokumen->category == 'Merchandising' ? 'selected' : '' }}>
                        Merchandising</option>
                    <option value="Marketing" {{ $dokumen->category == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                    <option value="Operation" {{ $dokumen->category == 'Operation' ? 'selected' : '' }}>Operation</option>
                    <option value="Property Development"
                        {{ $dokumen->category == 'Property Development' ? 'selected' : '' }}>Property Development</option>
                    <option value="Service Quality" {{ $dokumen->category == 'Service Quality' ? 'selected' : '' }}>Service
                        Quality</option>
                    <option value="Corporate Legal & Compliance"
                        {{ $dokumen->category == 'Corporate Legal & Compliance' ? 'selected' : '' }}>Corporate Legal &
                        Compliance</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Document</button>
        </form>
    </div>
@endsection
