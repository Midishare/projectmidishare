@extends('layouts.layoutsadmin')

@section('content')
<div class="container" style="margin-top: 7rem;">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12 bg-white p-4">
            <h2 class="text-center">Edit Repository</h2>
            <form method="post" action="{{ route('linkmod.editlink_process') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $linkmod->id }}" name="id">
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" value="{{ $linkmod->judullinkmod }}" name="judullinkmod" placeholder="Judul Berita">
                </div>
                <div class="form-group">
                    <label>Link</label>
                    <input type="text" class="form-control" value="{{ $linkmod->linkdrivemod }}" name="linkdrivemod" placeholder="Link Drive">
                </div>           
                <div class="form-group" style="margin-top: 2rem;">
                    <input type="submit" class="btn btn-primary" value="Edit">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection