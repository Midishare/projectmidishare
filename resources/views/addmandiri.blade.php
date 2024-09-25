@extends('layouts.layoutsadmin')

@section('content')
<section style="margin-top: 95px;">
    <div class="container" style="margin-left: 5rem;">
        <h4>Belajar Mandiri</h4>
    </div>
</section>

<section>
    <div class="col-md-8 col-sm-12 bg-white p-4">
        <div class="container" style="margin-left: 3.5rem;">
            <div class="card">
            <div class="card-body">
            <form method="post" action="/addmandiri_process" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Belajar Mandiri</label>
                    <input type="text" class="form-control" name="judul" placeholder="Judul artikel">
                </div>
                <br>
                <div class="form-group">
                    <label>Link</label>
                    <input type="text" class="form-control" name="link" placeholder="Link artikel">
                </div>
                <br>
                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" class="form-control" name="gambarmandiri" placeholder="Gambar artikel">
                </div>
        </div>
    </div>
    </div>
    </div> 
    <div class="col-md-3 ml-md-5 col-sm-12 bg-white p-4" style="height: 100px !important">
        <div class="container" style="margin-left: 3.5rem;">
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-sm-6" value="+ Upload">
            </div>
        </div>
    </div>    
    </form>
</section>
@endsection