@extends('layouts.layoutsadmin')

@section('content')
    <div class="container" style="margin-top: 7rem;">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12 bg-white p-4">
                <h2 class="text-center">Edit Belajar Mandiri</h2>
                <form method="post" action="{{ route('videoogm.editvidogm_process') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $videoogm->id }}" name="id">
                    <div class="form-group">
                        <label>Judul Video</label>
                        <input type="text" class="form-control" value="{{ $videoogm->judulvidogm }}" name="judulvidogm"
                            placeholder="Judul Video">
                    </div>
                    <div class="form-group">
                        <label>Link Video</label>
                        <input type="url" class="form-control" value="{{ $videoogm->linkogm }}" name="linkogm"
                            placeholder="Link Video">
                    </div>
                    <div class="form-group">
                        <label for="image">Upload Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*"
                            value="{{ $videoogm->image_path }}">
                    </div>
                    <div class="form-group" style="margin-top: 2rem;">
                        <input type="submit" class="btn btn-primary" value="Edit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
