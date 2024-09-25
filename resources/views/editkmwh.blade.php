@extends('layouts.layoutsadmin')

@section('content')

<div class="container" style="margin-top: 7rem;">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12 bg-white p-4">
            <h2 class="text-center">Edit Repository</h2>
            <form method="post" action="{{ route('knowledgewh.editkmwh_process') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$repositorykmwh->id}}" name="id">
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" value="{{$repositorykmwh->judulrepowh}}" name="judulrepowh" placeholder="Judul Berita">
                </div>
                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" name="gambarrepowh" class="form-control" rows="15" style="text-align: justify;">
                </div>  
                <div class="form-group">
                    <label>File</label>
                    <input type="file" name="dokumenfilerepowh" class="form-control" rows="15" style="text-align: justify;">
                </div>            
                <div class="form-group" style="margin-top: 2rem;">
                    <input type="submit" class="btn btn-primary" value="Edit">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection