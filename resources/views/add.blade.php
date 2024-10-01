{{-- @extends('layouts.layoutsadmin')

@section('content')
<section style="margin-top: 95px;">
    <div class="container" style="margin-left: 5rem;">
        <h4>News</h4>
    </div>
</section>

<section>
    <div class="col-md-8 col-sm-12 bg-white p-4">
        <div class="container" style="margin-left: 3.5rem;">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('berita.add_process') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Judul Berita</label>
                            <input type="text" class="form-control" name="judul" placeholder="Judul artikel" value="{{ old('judul') }}">
                        </div>
                        <div>
                            <label for="published_at">Publish Date</label>
                            <input type="date" name="published_at" id="published_at" class="form-control" value="{{ old('published_at') }}">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Isi Artikel</label>
                            <textarea id="deskripsi" class="form-control" name="deskripsi" rows="15">{{ old('deskripsi') }}</textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" class="form-control" name="gambar" placeholder="Gambar artikel">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#deskripsi').summernote({
            height: 300,
            placeholder: 'Tulis isi artikel di sini...',
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['forecolor', 'backcolor']],
                ['para', ['ul', 'ol', 'paragraph', 'height']],
                ['align', ['alignLeft', 'alignCenter', 'alignRight', 'alignJustify']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
@endsection --}}


@extends('layouts.layoutsadmin')

@section('content')
<section style="margin-top: 95px;">
    <div class="container" style="margin-left: 5rem;">
        <h4>News</h4>
    </div>
</section>

<section>
    <div class="col-md-8 col-sm-12 bg-white p-4">
        <div class="container" style="margin-left: 3.5rem;">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ route('berita.add_process') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Judul Berita</label>
                            <input type="text" class="form-control" name="judul" placeholder="Judul artikel" value="{{ old('judul') }}">
                        </div>
                        <div>
                            <label for="published_at">Publish Date</label>
                            <input type="date" name="published_at" id="published_at" class="form-control" value="{{ old('published_at') }}">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Isi Artikel</label>
                            <textarea id="deskripsi" class="form-control" name="deskripsi" rows="15">{{ old('deskripsi') }}</textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" class="form-control" name="gambar" placeholder="Gambar artikel">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Initialize Summernote
        $('#deskripsi').summernote({
            height: 300,
            placeholder: 'Tulis isi artikel di sini...',
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['forecolor', 'backcolor']],
                ['para', ['ul', 'ol', 'paragraph', 'height']],
                ['align', ['alignLeft', 'alignCenter', 'alignRight', 'alignJustify']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        // SweetAlert on Form Submit
        $('form').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            Swal.fire({
                title: 'Upload Berita Sekarang?',
                text: "Pastikan semua data sudah benar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, unggah sekarang!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    this.submit();
                }
            });
        });
    });
</script>

@endsection
