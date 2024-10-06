@extends('layouts.layoutsadmin')

@section('content')
<section style="margin-top: 95px;">
    <div class="container" style="margin-left: 5rem;">
        <h4>News</h4>
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
<style>
    </style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
