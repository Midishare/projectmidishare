@extends('layouts.layoutsadmin')

@section('content')
<div class="container">
    <h2 style="margin-top: 100px;">Add New Document</h2>

    <form action="{{ route('admin.mdp.materi.store') }}" method="POST" enctype="multipart/form-data">
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

        <div class="form-group mb-3">
            <label for="category">Category</label>
            <select name="category" class="form-control" id="category" required>
                <option value="">-- Select Category --</option>
                <option value="Business Controlling" {{ old('category') == 'Business Controlling' ? 'selected' : '' }}>Business Controlling</option>
                <option value="Corporate Audit" {{ old('category') == 'Corporate Audit' ? 'selected' : '' }}>Corporate Audit</option>
                <option value="Finance" {{ old('category') == 'Finance' ? 'selected' : '' }}>Finance</option>
                <option value="IT" {{ old('category') == 'IT' ? 'selected' : '' }}>IT</option>
                <option value="Merchandising" {{ old('category') == 'Merchandising' ? 'selected' : '' }}>Merchandising</option>
                <option value="Marketing" {{ old('category') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                <option value="Operation" {{ old('category') == 'Operation' ? 'selected' : '' }}>Operation</option>
                <option value="Property Development" {{ old('category') == 'Property Development' ? 'selected' : '' }}>Property Development</option>
                <option value="Service Quality" {{ old('category') == 'Service Quality' ? 'selected' : '' }}>Service Quality</option>
                <option value="Corporate Legal & Compliance" {{ old('category') == 'Corporate Legal & Compliance' ? 'selected' : '' }}>Corporate Legal & Compliance</option>
            </select>
        </div>
        

        <button type="submit" class="btn btn-primary">Create Document</button>
    </form>
</div>
@endsection
