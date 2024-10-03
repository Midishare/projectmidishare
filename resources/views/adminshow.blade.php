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
</style>

<div style="margin-top: 7rem;" class="animated fadeIn">
    <h2 class="text-center">List Berita</h2>
    @if($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismi  ss="alert">x</button>
        <strong>{{$message}}</strong>
    </div>
    @endif
    <div class="col-md-12 bg-white p-4">
        <div class="row">
            <div class="col-md-6">
                
                <a href="{{ route('berita.add') }}">
                    <button class="btn btn-primary mb-3"><strong>+</strong>Tambah</button>
                </a>
            </div>
            <div class="col-md-6 text-right">
                <!-- Form Pencarian -->
                <div class="row g-2 align-items-center justify-content-end"> <!-- Menggunakan justify-content-end untuk memindahkan ke pojok kanan -->
                    <div class="col-auto">
                        <input type="text" id="searchInput" class="form-control" aria-describedby="searchHelpInline" placeholder="Search...">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" onclick="searchBerita()"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <form id="bulkDeleteForm" method="POST" action="{{ route('berita.bulk_delete') }}">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger mt-4" onclick="confirmBulkDelete()">Hapus yang dipilih</button>
            <table class="table table-responsive table-bordered table-hover table-striped" style="margin-top: 1rem;">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>No.</th>
                        <th width="22%">Judul</th>
                        <th>Deskripsi</th>
                        <th width="13%">Tanggal Publish</th>
                        <th width="13%">Gambar</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $i => $berita)
                    <tr>
                        <td><input type="checkbox" name="ids[]" value="{{ $berita->id }}"></td>
                        <td>{{ $news->firstItem() + $i }}</td>
                        <td>{{ $berita->judul }}</td>
                        <td>{!! $berita->deskripsi !!}</td>
                        <td>{{ $berita->published_at }}</td>
                        <td><img src="{{ asset('storage/icon/' . $berita->gambar) }}" alt="Gambar Berita" style="max-width: 100px;"></td>
                        <td>
                            <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil-square" style="color: azure"></i>
                            </a>
                            <a href="javascript:void(0);" onclick="confirmDelete({{ $berita->id }})" class="btn btn-danger" style="color: azure">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        <div class="row justify-content-center">
            <div class="col-auto">
                {{ $news->links() }}
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function searchBerita() {
        var keyword = document.getElementById('searchInput').value;
        window.location.href = "{{ route('berita.show_by_admin') }}?search=" + keyword;
    }

    function confirmDelete(id) {
        Swal.fire({
            title: 'Ingin Menghapus Berita Ini?',
            text: "Apakah anda yakin ingin menghapus berita ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('berita.delete', '') }}/" + id;
            }
        })
    }

    function confirmBulkDelete() {
        Swal.fire({
            title: 'Ingin Menghapus Berita Yang Dipilih?',
            text: "Apakah anda yakin ingin menghapus berita yang dipilih?",
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
    }

    document.getElementById('selectAll').addEventListener('click', function(e) {
        var checkboxes = document.querySelectorAll('input[name="ids[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
    });
</script>
@endsection
