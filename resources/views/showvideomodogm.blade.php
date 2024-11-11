@extends('layouts.layoutsadmin')

@section('content')

<style>
    /* Animasi untuk fadeIn */
    .animated {
        animation-duration: 0.5s;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Efek hover untuk tombol tambah */
    .btn-primary:hover {
        transform: scale(1.05); /* Memperbesar tombol saat dihover */
        transition: transform 0.3s ease;
    }

    /* Efek hover untuk tombol edit dan hapus */
    .btn-warning:hover, .btn-danger:hover {
        filter: brightness(1.2); /* Meningkatkan kecerahan tombol saat dihover */
        transition: filter 0.3s ease;
    }
    .back-button {
        position: absolute;
        top: 100px; /* Menyesuaikan tinggi dari bagian atas */
        left: 20px;
        z-index: 999;
    }
</style>

<section class="animated fadeIn">
    <div style="margin-top: 7rem;">
        <h2 class="text-center">Materi Video SME</h2>
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="col-md-12 bg-white p-4">
            <a href="{{ route('videoogm.addvidmodogm') }}">
                <button class="btn btn-primary mb-3"><strong>+</strong>Tambah</button>
            </a>
            <!-- Form Pencarian -->
            <div class="row g-2 align-items-center justify-content-end">
                <div class="col-auto">
                    <input type="text" id="searchInput" class="form-control" aria-describedby="searchHelpInline" placeholder="Search...">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" onclick="searchBerita()"><i class="bi bi-search"></i></button>
                </div>
            </div>

            <form action="{{ route('videoogm.delete_multiple') }}" method="POST" id="bulkDeleteForm">
                @csrf
                <button type="submit" class="btn btn-danger mb-3 mt-3">Hapus Terpilih</button>
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
                        @foreach($videoogm as $i => $video)
                            <tr>
                                <td><input type="checkbox" name="selected_videos[]" value="{{ $video->id }}"></td>
                                <td>{{ ++$i }}</td>
                                <td>{{ $video->judulvidogm }}</td>
                                <td>
                                    @php
                                        $isYoutube = strpos($video->linkogm, 'youtube.com') !== false || strpos($video->linkogm, 'youtu.be') !== false;
                                        $isGoogleDrive = strpos($video->linkogm, 'drive.google.com') !== false;
                                        $googleDriveId = '';
                                
                                        // Extract Google Drive file ID if it's a Google Drive link
                                        if ($isGoogleDrive) {
                                            preg_match('/\/d\/(.*?)\//', $video->linkogm, $matches);
                                            $googleDriveId = $matches[1] ?? '';
                                        }
                                    @endphp
                                
                                    @if ($isYoutube || ($isGoogleDrive && $googleDriveId))
                                        <!-- Display a clickable link -->
                                        <a href="{{ $video->linkogm }}" target="_blank">Lihat Video</a>
                                    @else
                                        <span>Format tidak didukung</span>
                                    @endif
                                </td>                                                               
                                <td>
                                    <a href="{{ route('videoogm.editvidogm', $video->id) }}" class="btn btn-warning">
                                        <i class="bi bi-pencil-square" style="color: azure"></i>
                                    </a>
                                    <a href="{{ route('videoogm.deletevidmodogm', $video->id) }}" class="btn btn-danger" style="color: azure">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            <div class="d-flex justify-content-center">
                {{ $videoogm->links() }}
            </div>
        </div>
    </div>
</section>
<script>
    document.getElementById('selectAll').onclick = function() {
        var checkboxes = document.getElementsByName('selected_videos[]');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    }

    function searchBerita() {
        var keyword = document.getElementById('searchInput').value;
        window.location.href = "{{ route('videoogm.show_by_adminvidogmshow') }}?search=" + keyword;
    }
</script>
@endsection
