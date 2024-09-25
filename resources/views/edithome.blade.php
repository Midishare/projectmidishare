@extends('layouts.layoutsadmin')

@section('content')

<section style="margin-top: 95px;">
    <div class="container" style="margin-left: 5rem;">
        <h4>Edit Home</h4>
    </div>
</section>

<section>
    <div class="col-md-8 col-sm-12 bg-white p-4">
        <div class="container" style="margin-left: 3.5rem;">
            <div class="card">
            <div class="card-body">
            <form method="post" action="{{ route('dashboard.edithome_process') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $home->id }}" name="id">
                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" class="form-control" id="gambar" name="image">
                </div>               
                <div class="form-group" style="margin-top: 2rem;">
                    <input type="submit" class="btn btn-primary" value="Edit">
                </div>
            </form>
        </div>
    </div>
</div>
</section>
@endsection

