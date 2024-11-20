@extends('layouts.layoutsadmin')

@section('content')
    <div class="container">
        <h2 style="margin-top: 100px;">Add New Video</h2>

        <form action="{{ route('admin.dp.video.update', $video->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $video->title) }}" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="link" class="form-label">Video Link</label>
                <input type="url" class="form-control" id="link" name="link"
                    value="{{ old('link', $video->link) }}" required>
                @error('link')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="category">Category</label>
                <select name="category" class="form-control" id="category" required>
                    <option value="">-- Semua Category --</option>
                    <option value="Human Capital" {{ $video->category == 'Human Capital' ? 'selected' : '' }}>Human Capital
                    </option>
                    <option value="Business Controlling" {{ $video->category == 'Business Controlling' ? 'selected' : '' }}>
                        Business Controlling</option>
                    <option value="Corporate Audit" {{ $video->category == 'Corporate Audit' ? 'selected' : '' }}>Corporate
                        Audit</option>
                    <option value="Finance" {{ $video->category == 'Finance' ? 'selected' : '' }}>Finance</option>
                    <option value="IT" {{ $video->category == 'IT' ? 'selected' : '' }}>IT</option>
                    <option value="Merchandising" {{ $video->category == 'Merchandising' ? 'selected' : '' }}>Merchandising
                    </option>
                    <option value="Marketing" {{ $video->category == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                    <option value="Operation" {{ $video->category == 'Operation' ? 'selected' : '' }}>Operation</option>
                    <option value="Property Development"
                        {{ $video->category == 'Property Development' ? 'selected' : '' }}>Property Development</option>
                    <option value="Service Quality" {{ $video->category == 'Service Quality' ? 'selected' : '' }}>Service
                        Quality</option>
                    <option value="Corporate Legal & Compliance"
                        {{ $video->category == 'Corporate Legal & Compliance' ? 'selected' : '' }}>Corporate Legal &
                        Compliance</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Video</button>
        </form>
    </div>
@endsection
