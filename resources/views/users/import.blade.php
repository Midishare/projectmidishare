@extends('layouts.layoutsadmin')

@section('content')

<a href="{{ route('users.index') }}" class="btn btn-secondary mb-3">Back</a>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-0">Import Users</h1>
                </div>
                <div class="card-body">
                   
                    <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Choose Excel File</label>
                            <input type="file" class="form-control-file" id="file" name="file" accept=".xlsx, .xls" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Import Users</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection