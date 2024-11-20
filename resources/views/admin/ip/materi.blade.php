@extends('layouts.layoutsadmin')

@section('content')
    <div class="container">
        <h2 style="margin-top: 100px;">IP - Materi Dokumen</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif

        <div class="col-md-6">
            <a href="{{ route('admin.ip.materi.create') }}">
                <button class="btn btn-primary mb-3"><strong>+</strong> Tambah</button>
            </a>
        </div>

        <div class="col-md-12 text-right">
            <div class="row g-2 align-items-center justify-content-end">
                <div class="col-auto">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" onclick="searchBerita()"><i class="bi bi-search"></i> Search</button>
                </div>
            </div>
        </div>

        <form id="bulkDeleteForm" method="POST" action="{{ route('admin.ip.materi.bulkDelete') }}">
            @csrf
            <button type="button" class="btn btn-danger mt-4" onclick="confirmBulkDelete()">Hapus yang dipilih</button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>Link Dokumen</th>
                        <th>Tanggal Publikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documents as $index => $document)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $document->title }}</td>
                            <td><img src="{{ asset('storage/' . $document->image_path) }}" alt="Document Image"
                                    width="100"></td>
                            <td><a href="{{ $document->link }}" target="_blank">View Document</a></td>
                            <td>{{ $document->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('admin.ip.materi.edit', $document->id) }}"
                                    class="btn btn-primary">Edit</a>
                                <a href="javascript:void(0);" class="btn btn-danger"
                                    onclick="confirmDelete({{ $document->id }})">Delete</a>
                                <input type="checkbox" name="document_ids[]" value="{{ $document->id }}">
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
            window.location.href = "{{ route('admin.ip.materi') }}?search=" + encodeURIComponent(keyword);
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Ingin Menghapus Materi Ini?',
                text: "Apakah anda yakin ingin menghapus materi ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('admin.ip.materi.destroy', '') }}/" + id;
                }
            });
        }

        function confirmBulkDelete() {
            Swal.fire({
                title: 'Ingin Menghapus Materi Yang Dipilih?',
                text: "Apakah anda yakin ingin menghapus materi yang dipilih?",
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
