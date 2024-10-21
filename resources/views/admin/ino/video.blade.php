@extends('layouts.layoutsadmin')

@section('content')
<style>
    .animated {
        animation-duration: 0.5s;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>

<div style="margin-top: 7rem;" class="animated fadeIn">
    <h2 class="text-center">Inofest - Video</h2>
    @if($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="col-md-12 bg-white p-4">
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('admin.ino.video.create') }}">
                    <button class="btn btn-primary mb-3"><strong>+</strong>Tambah Video</button>
                </a>
            </div>
            <div class="col-md-6 text-right">
                <div class="row g-2 align-items-center justify-content-end">
                    <div class="col-auto">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" onclick="searchVideo()"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <form id="bulkDeleteForm" method="POST" action="{{ route('admin.ino.video.bulkDelete') }}">
            @csrf
            <button type="button" class="btn btn-danger mt-4" onclick="confirmBulkDelete()">Hapus yang dipilih</button>
            <table class="table table-responsive table-bordered table-hover table-striped" style="margin-top: 1rem;">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>Judul</th>
                        <th>Link Video</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($videos as $i => $video)
                    <tr>
                        <td><input type="checkbox" name="ids[]" value="{{ $video->  id }}"></td>
                        <td>{{ $video->title }}</td>
                        <td><a href="{{ $video->video_link }}" target="_blank">View Video</a></td>
                        <td>
                            <a href="{{ route('admin.ino.video.edit', $video->id) }}" class="btn btn-warning">Edit</a>
                            <a href="javascript:void(0);" onclick="confirmDelete({{ $video->id }})" class="btn btn-danger">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        <div class="row justify-content-center">
            <div class="col-auto">
                {{ $videos->links() }}
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function searchVideo() {
        var keyword = document.getElementById('searchInput').value;
        window.location.href = "{{ route('admin.ino.video') }}?search=" + keyword;
    }

    function confirmDelete(id) {
        Swal.fire({
            title: 'Ingin Menghapus Video Ini?',
            text: "Apakah anda yakin ingin menghapus video ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('admin.ino.video.destroy', '') }}/" + id;
            }
        })
    }

    function confirmBulkDelete() {
        var selected = document.querySelectorAll('input[name="ids[]"]:checked').length;
        if (selected > 0) {
            Swal.fire({
                title: 'Ingin Menghapus Video Yang Dipilih?',
                text: "Apakah anda yakin ingin menghapus video yang dipilih?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('bulkDeleteForm').submit();
                }
            })
        } else {
            Swal.fire('Tidak ada video yang dipilih!', '', 'info');
        }
    }

    document.getElementById('selectAll').addEventListener('click', function(e) {
        var checkboxes = document.querySelectorAll('input[name="ids[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
    });
</script>
@endsection
