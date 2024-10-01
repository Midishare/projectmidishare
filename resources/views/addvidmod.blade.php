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
                <form action="{{ route('video.addvidmod_process') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="judulvidmod">Judul Video:</label>
                        <input type="text" class="form-control" id="judulvidmod" name="judulvidmod" required>
                    </div>
                    <div class="form-group">
                        <label for="linkmod">Link Video:</label>
                        <input type="text" class="form-control" id="linkmod" name="linkmod" required>
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