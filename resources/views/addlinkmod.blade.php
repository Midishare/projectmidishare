@extends('layouts.layoutsadmin')

@section('content')
<section style="margin-top: 95px;">
    <div class="container" style="margin-left: 5rem;">
        <h4>Add Link Dokumen Pembelajaran Mod</h4>
    </div>
</section>
<section>
    <div class="col-md-8 col-sm-12 bg-white p-4">
        <div class="container" style="margin-left: 3.5rem;">
            <div class="card">
            <div class="card-body">
                <form action="{{ route('linkmod.addlinkmod_process') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="judullinkmod">Judul</label>
                        <input type="text" class="form-control" id="judullinkmod" name="judullinkmod" required>
                    </div>
                    <div class="form-group">
                        <label for="linkdrivemod">Link</label>
                        <input type="text" class="form-control" id="linkdrivemod" name="linkdrivemod" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Tambah Link</button>
                </form>                
</div>
</div>
</div>
</div>
</section>
@endsection