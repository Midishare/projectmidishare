{{-- @extends('layouts.layoutsadmin')

@section('content')
<section style="margin-top: 95px;">
    <div class="container" style="margin-left: 5rem;">
        <h4>Add Video Pembelajaran Mod OGM</h4>
    </div>
</section>

<section>
    <div class="col-md-8 col-sm-12 bg-white p-4">
        <div class="container" style="margin-left: 3.5rem;">
            <div class="card">
            <div class="card-body">
            <form method="post" action="/addvidmodogm_process" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Judul Video Mod OGM</label>
                    <input type="text" class="form-control" name="judulvidogm" placeholder="Judul artikel">
                </div>
                <br>
                <div class="form-group">
                    <label>Dokumen Video</label>
                    <input type="file" class="form-control" name="dokumenvideoogm" placeholder="dokumen file">
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Upload">
                </div>     
    </form>
    </div>
</div>
</div>
</div>
</section>
@endsection --}}

@extends('layouts.layoutsadmin')

@section('content')
<section style="margin-top: 95px;">
    <div class="container" style="margin-left: 5rem;">
        <h4>Add Video Pembelajaran Mod</h4>
    </div>
</section>

<section>
    <div class="col-md-8 col-sm-12 bg-white p-4">
        <div class="container" style="margin-left: 3.5rem;">
            <div class="card">
            <div class="card-body">
                <form action="{{ route('videoogm.addvidmodogm_process') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="judulvidogm">Judul Video:</label>
                        <input type="text" class="form-control" id="judulvidogm" name="judulvidogm" required>
                    </div>
                    <div class="form-group">
                        <label for="linkwh">Link Video:</label>
                        <input type="text" class="form-control" id="linkogm" name="linkogm" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Tambah Video</button>
                </form>                
</div>
</div>
</div>
</div>
</section>
@endsection