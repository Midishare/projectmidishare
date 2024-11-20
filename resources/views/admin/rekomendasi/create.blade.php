@extends('layouts.layoutsadmin')

@section('content')
    <div class="container" style="margin-top: 100px;">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif
        <h2>{{ isset($rekomendasi) ? 'Edit' : 'Tambah' }} Rekomendasi Belajar</h2>

        <form id="rekomendasiForm" action="{{ route('rekomendasi.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">Pilih Pengguna:</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            {{ isset($rekomendasi) && $rekomendasi->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="rekomendasi">Rekomendasi Belajar:</label>
                <div id="rekomendasi" class="summernote" style="height: 200px;">
                    {{ isset($rekomendasi) ? $rekomendasi->rekomendasi : '' }}</div>
                <input type="hidden" name="rekomendasi" id="rekomendasi-input">
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($rekomendasi) ? 'Update' : 'Simpan' }}</button>
        </form>


    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#rekomendasi').summernote({
                placeholder: 'Tulis rekomendasi belajar di sini...',
                tabsize: 2,
                height: 200
            });
            $('#rekomendasiForm').on('submit', function(event) {
                $('#rekomendasi-input').val($('#rekomendasi').summernote('code'));
                if (!confirm('Apakah Anda yakin ingin menyimpan rekomendasi belajar ini?')) {
                    event.preventDefault();
                }
            });
            $('#user_id').change(function() {
                var userId = $(this).val();
                if (userId) {
                    $.ajax({
                        url: '{{ route('rekomendasi.get') }}',
                        method: 'GET',
                        data: {
                            user_id: userId
                        },
                        success: function(response) {
                            $('#rekomendasi').summernote('code', response.rekomendasi);
                        },
                        error: function(xhr) {
                            console.error(xhr);
                        }
                    });
                } else {
                    $('#rekomendasi').summernote('code', '');
                }
            });
        });
    </script>
@endsection
