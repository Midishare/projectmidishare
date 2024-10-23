@extends('layouts.layoutsadmin')

@section('content')
<section>
    <div style="margin-top: 7rem;">
        <h2 class="text-center" style="font-family: 'Roboto', sans-serif; font-size: 2.5rem; font-weight: bold; color: #333;">Belajar <span style="color: #e92525;">Mandiri</span></h2>
        @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{$message}}</strong>
        </div>
        @endif
        <div class="col-md-12 bg-white p-4">
            <a href="{{ route('belajarmandiri.addmandiri') }}">
                <button class="btn btn-primary mb-3"><strong>+</strong>Tambah</button>
            </a>
            <div class="row g-2 align-items-center justify-content-end">
                <div class="col-auto">
                    <input type="text" id="searchInput" class="form-control" aria-describedby="searchHelpInline" placeholder="Search...">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" onclick="searchBerita()"><i class="bi bi-search"></i></button>
                </div>
            </div>
            <form id="bulkDeleteForm" action="{{ route('belajarmandiri.berita_bulk_delete') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger mt-4" onclick="confirmBulkDelete()">Hapus yang dipilih</button>
                <table class="table table-responsive table-bordered table-hover table-striped table-news">
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
                        @foreach($belajarmandiri as $i => $item)
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="{{ $item->id }}"></td>
                            <td><p>{{ $belajarmandiri->firstItem() + $i }}</p></td>
                            <td><p>{{ $item->judul }}</p></td>
                            <td><p>{!! $item->deskripsi !!}</p></td>
                            <td><p>{{ $item->published_at }}</p></td>
                            <td><img src="{{ asset('storage/icon/' . $item->gambar) }}" alt="Gambar Belajar Mandiri" style="max-width: 100px;"></td>
                            <td>
                                <a href="{{ route('belajarmandiri.editmandiri', $item->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil-square" style="color: azure"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="confirmDelete({{ $item->id }})" class="btn btn-danger" style="color: azure">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            {{ $belajarmandiri->links() }}
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function searchBerita() {
        var keyword = document.getElementById('searchInput').value;
        window.location.href = "{{ route('belajarmandiri.show_by_adminmandirishow') }}?search=" + keyword;
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
                window.location.href = "{{ route('belajarmandiri.deletemandiri', '') }}/" + id;
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
