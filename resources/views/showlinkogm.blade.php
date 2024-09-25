@extends('layouts.layoutsadmin')

@section('content')

<section>
    <style>
        /* Custom styling */
        .back-button {
            position: absolute;
            top: 100px;
            left: 20px;
            z-index: 999;
        }
        #searchInput {
            margin-bottom: 0;
            margin-top: -50px;
            height: 40px;
            padding-top: 0.375rem;
            padding-bottom: 0.375rem;
        }
        .search-button {
            margin-top: -50px;
        }
    </style>

    <div style="margin-top: 7rem;">
        <h2 class="text-center">List Link Dokumen Operation General Manager</h2>
        
        @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif

        <div class="col-md-12 bg-white p-4">
            <a href="{{ route('linkogm.addlinkogm') }}">
                <button class="btn btn-primary mb-3"><strong>+</strong>Tambah</button>
            </a>

            <div class="row g-2 align-items-center justify-content-end">
                <div class="col-auto">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                </div>
                <div class="col-auto search-button">
                    <button class="btn btn-primary" onclick="searchBerita()"><i class="bi bi-search"></i></button>
                </div>
            </div>

            <form id="deleteForm" method="POST" action="{{ route('linkogm.deleteSelected') }}">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger mb-3" id="deleteSelectedButton">Hapus Terpilih</button>

                <table class="table table-responsive table-bordered table-hover table-striped" style="margin-top: 2rem;">
                    <thead>
                        <tr>
                            <th width="1%"><input type="checkbox" id="selectAll"></th>
                            <th width="1%">No.</th>
                            <th width="15%">Judul</th>
                            <th width="15%">Link</th>
                            <th width="13%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($linkogm as $index => $repo)
                        <tr>
                            <td><input type="checkbox" name="selectedItems[]" value="{{ $repo->id }}"></td>
                            <td>{{ $index + 1}}</td>
                            <td>{{ $repo->judullinkogm }}</td>
                            <td><a href="{{ $repo->linkdriveogm }}" target="_blank">{{ $repo->linkdriveogm }}</a></td>
                            <td>
                                <a href="{{ route('linkogm.editlinkogm', $repo->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil-square" style="color: azure"></i>
                                </a>
                                <button type="button" class="btn btn-danger" style="color: azure" onclick="confirmDelete({{ $repo->id }})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>

            <div class="d-flex justify-content-center">
                {{ $linkogm->links() }}
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function searchBerita() {
        var keyword = document.getElementById('searchInput').value;
        window.location.href = "{{ route('linkogm.show_by_adminlinkogmshow') }}?search=" + keyword;
    }

    // SweetAlert confirmation for delete
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('linkogm.deletelinkogm', '') }}/" + id;
            }
        })
    }

    // Select all checkboxes
    document.getElementById("selectAll").onclick = function() {
        var checkboxes = document.getElementsByName("selectedItems[]");
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    };

    // SweetAlert confirmation for bulk delete
    document.getElementById('deleteSelectedButton').onclick = function() {
        Swal.fire({
            title: 'Yakin ingin menghapus terpilih?',
            text: "Data yang dipilih akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm').submit();
            }
        })
    };
</script>
@endsection
