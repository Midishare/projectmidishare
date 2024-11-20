@extends('layouts.layoutsadmin')

@section('content')
    <section style="margin-top: 95px;">
        <div class="container" style="margin-left: 5rem;">
            <h4>Add Link Dokumen Pembelajaran SME</h4>
        </div>
    </section>

    <section>
        <div class="col-md-8 col-sm-12 bg-white p-4">
            <div class="container" style="margin-left: 3.5rem;">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('linkogm.addlinkogm_process') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="judullinkogm">Judul</label>
                                <input type="text" class="form-control" id="judullinkogm" name="judullinkogm" required>
                            </div>
                            <div class="form-group">
                                <label for="linkdriveogm">Link</label>
                                <input type="text" class="form-control" id="linkdriveogm" name="linkdriveogm" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Upload Gambar</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*"
                                    required>
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
