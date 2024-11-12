@extends('layouts.layoutsadmin')

@section('content')
    <section style="margin-top: 95px;">
        <div class="container" style="margin-left: 5rem;">
            <h4>Add Video Pembelajaran Mod</h4>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li> {{ $item }}</li>
                    @endforeach
                </ul>

            </div>
        @endif
    </section>

    <section>
        <div class="col-md-8 col-sm-12 bg-white p-4">
            <div class="container" style="margin-left: 3.5rem;">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('videoogm.addvidmodogm_process') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="judulvidogm">Judul Video:</label>
                                <input type="text" class="form-control" id="judulvidogm" name="judulvidogm" required>
                            </div>
                            <div class="form-group">
                                <label for="linkwh">Link Video:</label>
                                <input type="text" class="form-control" id="linkogm" name="linkogm" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Upload Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
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
