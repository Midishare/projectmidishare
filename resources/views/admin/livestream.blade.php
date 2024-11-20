@extends('layouts.layoutsadmin')

@section('content')
    <div class="container" style="margin-top: 150px;">
        <h1>Admin Livestream</h1>
        <form action="{{ route('livestream.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="url" class="form-label">Livestream URL</label>
                <input type="url" class="form-control" id="url" name="url" placeholder="Enter YouTube URL"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Update Livestream</button>
        </form>

        <form action="{{ route('livestream.delete') }}" method="POST" style="margin-top: 20px;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Livestream</button>
        </form>
    </div>
@endsection
