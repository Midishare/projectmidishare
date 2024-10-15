@extends('layouts.layoutsadmin')

@section('content')
<div class="container">
    <h2 style="margin-top: 100px;">Add New Video</h2>
    <form action="{{ route('admin.dp.video.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="link">Video Link</label>
            <input type="url" class="form-control" id="link" name="link" required>
        </div>
        <div class="form-group mb-3">
            <label for="category">Category</label>
            <select name="category" class="form-control" id="category" required>
                <option value="">-- Select Category --</option>
                <option value="Business Controlling">Business Controlling</option>
                <option value="Corporate Audit">Corporate Audit</option>
                <option value="Finance">Finance</option>
                <option value="IT">IT</option>
                <option value="Merchandising">Merchandising</option>
                <option value="Marketing">Marketing</option>
                <option value="Operation">Operation</option>
                <option value="Property Development">Property Development</option>
                <option value="Service Quality">Service Quality</option>
                <option value="Corporate Legal & Compliance">Corporate Legal & Compliance</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Video</button>
    </form>
</div>
@endsection