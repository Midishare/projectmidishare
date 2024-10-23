@extends('layouts.layoutsadmin')

@section('content')
<section style="margin-top: 95px;">
    <div class="container" style="margin-left: 5rem;">
        <h4>Tambah Event</h4>
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
                    <form method="post" action="{{ route('events.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Judul Event</label>
                            <input type="text" class="form-control" name="title" placeholder="Judul event" value="{{ old('title') }}">
                        </div>
                        <div>
                            <label for="published_at">Tanggal Publish</label>
                            <input type="date" name="published_at" id="published_at" class="form-control" value="{{ old('published_at') }}">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Deskripsi Event</label>
                            <textarea id="description" class="form-control" name="description" rows="15">{{ old('description') }}</textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" class="form-control" name="image" placeholder="Gambar event">
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
        // Initialize Summernote for description
        $('#description').summernote({
            height: 300,
            minHeight: null, 
            maxHeight: null, 
            focus: true,
            placeholder: 'Tulis isi event di sini...',
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
    if (window.confirm('Upload event Sekarang?\nPastikan semua data sudah benar!')) {
        // Jika pengguna memilih "OK", form akan dikirim
        this.submit();
    }
});
    });
</script>
@endsection
