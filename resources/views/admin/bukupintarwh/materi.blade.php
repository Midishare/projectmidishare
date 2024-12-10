@extends('layouts.layoutsadmin')

@section('content')
    <div class="container">
        <h2 style="margin-top: 100px;">Admin buku pintar wh slide</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif

        <div class="col-md-6">
            <a href="{{ route('admin.bukupintarwh.materi.store') }}">
                <button class="btn btn-primary mb-3"><strong>+</strong> Tambah</button>
            </a>
        </div>
        <div class="col-md-12 text-right">
            <!-- Form Pencarian -->
            <div class="row g-2 align-items-center justify-content-end">
                <div class="col-auto">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" onclick="searchBerita()"><i class="bi bi-search"></i> Search</button>
                </div>
            </div>
        </div>

        <form id="bulkDeleteForm" method="POST" action="{{ route('admin.bukupintarwh.materi.bulkDelete') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <button type="button" class="btn btn-danger" onclick="confirmBulkDelete()">Hapus yang dipilih</button>
                </div>

            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>Tanggal Publikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materiDokumen as $index => $document)
                        <tr>
                            <td>
                                <input type="checkbox" name="document_ids[]" value="{{ $document->id }}">
                            </td>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $document->title }}</td>
                            <td>
                                @if (is_string($document->file_paths))
                                    @foreach (json_decode($document->file_paths) as $path)
                                        <img src="{{ asset($path) }}" width="100" alt="Image">
                                    @endforeach
                                @elseif (is_array($document->file_paths))
                                    @foreach ($document->file_paths as $path)
                                        <img src="{{ asset($path) }}" width="100" alt="Image">
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ $document->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('admin.bukupintarwh.materi.edit', $document->id) }}"
                                    class="btn btn-primary">Edit</a>
                                <a href="javascript:void(0);" class="btn btn-danger"
                                    onclick="confirmDelete({{ $document->id }})">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function searchBerita() {
            let keyword = document.getElementById('searchInput').value;
            window.location.href = "{{ route('admin.bukupintarwh.materi') }}?search=" + encodeURIComponent(keyword);
        }


        function confirmDelete(id) {
            Swal.fire({
                title: 'Ingin Menghapus Berita Ini?',
                text: "Apakah anda yakin ingin menghapus materi ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('admin.bukupintarwh.materi.destroy', '') }}/" + id;
                }
            });
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
            });
        }
        const selectAllCheckbox = document.getElementById('selectAll');
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('click', function(e) {
                var checkboxes = document.querySelectorAll('input[name="document_ids[]"]');
                checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
            });
        }
    </script>
@endsection
