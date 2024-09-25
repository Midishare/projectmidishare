{{-- @extends('layouts.layouts')

@section('content')

<div class="container" style="margin-top: 7rem;">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12 bg-white p-4">
            <h2 class="text-center">Edit Belajar Mandiri</h2>
            <form method="post" action="{{ route('videowh.editvidwh_process') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$videowh->id}}" name="id">
                <div class="form-group">
                    <label>Judul <Video></Video></label>
                    <input type="text" class="form-control" value="{{$videowh->judulvidwh}}" name="judulvidwh" placeholder="Judul Berita">
                </div>
                <div class="form-group">
                    <label>File</label>
                    <input type="file" name="dokumenvideowh" class="form-control">
                </div> 
                <div class="form-group" style="margin-top: 2rem;">
                    <input type="submit" class="btn btn-primary" value="Edit">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.layoutsadmin')

@section('content')
<div class="container" style="margin-top: 7rem;">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12 bg-white p-4">
            <h2 class="text-center">Edit Belajar Mandiri Ware House</h2>
            <form method="post" action="{{ route('videowh.editvidwh_process') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $videowh->id }}" name="id">
                <div class="form-group">
                    <label>Judul Video</label>
                    <input type="text" class="form-control" value="{{ $videowh->judulvidwh }}" name="judulvidwh" placeholder="Judul Video">
                </div>
                <div class="form-group">
                    <label>Link Video</label>
                    <input type="url" class="form-control" value="{{ $videowh->linkwh }}" name="linkwh" placeholder="Link Video">
                </div>                 
                <div class="form-group" style="margin-top: 2rem;">
                    <input type="submit" class="btn btn-primary" value="Edit">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection