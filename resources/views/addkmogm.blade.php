@extends('layouts.layoutsadmin')

@section('content')
    <section style="margin-top: 95px;">
        <div class="container" style="margin-left: 5rem;">
            <h4>Repository OGM</h4>
        </div>
    </section>

    <section>
        <div class="col-md-8 col-sm-12 bg-white p-4">
            <div class="container" style="margin-left: 3.5rem;">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/addkmogm_process" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" class="form-control" name="judulrepoogm" placeholder="Judul artikel">
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" class="form-control" name="gambarrepoogm" placeholder="gambar file">
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Dokumen File</label>
                                <input type="file" class="form-control" name="dokumenfilerepoogm"
                                    placeholder="dokumen file">
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
@endsection
