@extends('layouts.layoutsadmin')

@section('content')
<div class="container" style="margin-top: 100px;">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif
    <h2>{{ isset($history) ? 'Edit' : 'Tambah' }} History</h2>

    <form id="rekomendasiForm" action="{{ route('history.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">Pilih Pengguna:</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ (isset($history) && $history->user_id == $user->id) ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="history">History:</label>
            <textarea id="history" class="summernote" name="history">{{ isset($history) ? $history->history : '' }}</textarea>
            <input type="hidden" name="history" id="history-input">
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($history) ? 'Update' : 'Simpan' }}</button>
    </form>
    
    
</div>

<script>
    $(document).ready(function() {
    $('#history').summernote({
        placeholder: 'Tulis history belajar di sini...',
        tabsize: 2,
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']], // Menambahkan opsi table
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    // Update hidden input on form submit
    $('#rekomendasiForm').on('submit', function(event) {
        $('#history-input').val($('#history').summernote('code'));
        
        // Confirmation prompt
        if (!confirm('Apakah Anda yakin ingin menyimpan history belajar ini?')) {
            event.preventDefault(); // Prevent form submission
        }
    });

    // AJAX untuk mengambil history saat pengguna dipilih
    $('#user_id').change(function() {
        var userId = $(this).val();
        if (userId) {
            $.ajax({
                url: '{{ route('history.get') }}',
                method: 'GET',
                data: { user_id: userId },
                success: function(response) {
                    $('#history').summernote('code', response.history);
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        } else {
            $('#history').summernote('code', '');
        }
    });
});
</script>
@endsection
