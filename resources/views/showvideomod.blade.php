@extends('layouts.layoutsadmin')

<style>
    .back-button {
        position: absolute;
        top: 80px; /* Menyesuaikan tinggi dari bagian atas */
        left: 20px;
        z-index: 999;
    }
</style>

@section('content')
<section>
    <div style="margin-top: 7rem;">
        <h2 class="text-center">List Video People Development Manager</h2>
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="col-md-12 bg-white p-4">
            <a href="{{ route('video.addvidmod') }}">
                <button class="btn btn-primary mb-3"><strong>+</strong>Tambah</button>
            </a>
            <!-- Form Pencarian -->
            <div class="row g-2 align-items-center justify-content-end"> <!-- Mengubah align-items-center menjadi justify-content-end -->
                <div class="col-auto">
                    <input type="text" id="searchInput" class="form-control" aria-describedby="searchHelpInline" placeholder="Search...">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" onclick="searchBerita()"><i class="bi bi-search"></i></button>
                </div>
            </div>
            <form id="bulkDeleteForm" action="{{ route('video.bulk_delete') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mb-3" onclick="return confirm('Apakah Anda yakin ingin menghapus item yang dipilih?')">Hapus yang Dipilih</button>
                <table class="table table-responsive table-bordered table-hover table-striped" style="margin-top: 2rem;">
                    <thead>
                        <tr>
                            <th width="1%"><input type="checkbox" id="selectAll"></th>
                            <th width="1%">No.</th>
                            <th width="22%">Judul</th>
                            <th width="13%">Video</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($videomod as $index => $video)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{ $video->id }}"></td>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $video->judulvidmod }}</td>
                                <td>
                                    @if (strpos($video->linkmod, 'youtube.com') !== false || strpos($video->linkmod, 'youtu.be') !== false)
                                        <a href="{{ $video->linkmod }}" target="_blank">Lihat Video</a>
                                    @else
                                        <span>Format tidak didukung</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('video.editvidmod', $video->id) }}" class="btn btn-warning">
                                        <i class="bi bi-pencil-square" style="color: azure"></i>
                                    </a>
                                    <a href="{{ route('video.deletevidmod', $video->id) }}" class="btn btn-danger" style="color: azure">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            <div class="d-flex justify-content-center">
                {{ $videomod->links() }}
            </div>
        </div>
    </div>
</section>
<script>
    function searchBerita() {
        var keyword = document.getElementById('searchInput').value;
        window.location.href = "{{ route('video.show_by_adminvidshow') }}?search=" + keyword;
    }
    
    document.getElementById('selectAll').onclick = function() {
        var checkboxes = document.querySelectorAll('input[name="ids[]"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    };
</script>
@endsection
