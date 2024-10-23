@extends('layouts.layoutsadmin')

@section('content')
<section style="margin-top: 95px;">
    <div class="container" style="margin-left: 5rem;">
        <h4>Belajar Mandiri</h4>
    </div>
</section>

<section>
    <div class="col-md-8 col-sm-12">
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
                    <form method="post" action="{{ route('belajarmandiri.addmandiri_process') }}" enctype="multipart/form-data">
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
<script>
    $(document).ready(function() {
        // Initialize Summernote
        $('#deskripsi').summernote({
            height: 300,
            minHeight: null, 
            maxHeight: null, 
            focus: true,
            placeholder: 'Tulis isi artikel di sini...',
            toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['forecolor', 'backcolor']],
                    ['para', ['ul', 'ol', 'paragraph', 'height']],
                    ['align', ['alignLeft', 'alignCenter', 'alignRight', 'alignJustify']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
        });

        $('form').on('submit', function(event) {
    event.preventDefault(); // Mencegah form terkirim secara default

    // Menampilkan jendela konfirmasi standar browser
    if (window.confirm('Upload bejar mandiri Sekarang?\nPastikan semua data sudah benar!')) {
        // Jika pengguna memilih "OK", form akan dikirim
        this.submit();
    }
});

    });
</script>

@endsection
