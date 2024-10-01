@extends('layouts.layoutsadmin')

@section('content')
<section>
<style> 
    .back-button {
        position: absolute;
        top: 100px; /* Menyesuaikan tinggi dari bagian atas */
        left: 20px;
        z-index: 999;
    }

    /* New CSS for the search bar */
    .search-container {
        position: absolute;
        top: 250px; /* Adjust as needed */
        right: 20px; /* Adjust as needed */
        display: flex;
        align-items: center;
    }

    .search-container input[type=text] {
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .search-container button {
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 5px;
    }
</style>
<div style="margin-top: 7rem;">
    <h2 class="text-center">List Link Dokumen People Development Manager</h2>
    @if($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="col-md-12 bg-white p-4">
        <a href="{{ route('linkmod.addlinkmod') }}">
            <button class="btn btn-primary mb-3"><strong>+</strong>Tambah</button>
        </a>
        <div class="search-container">
            <input type="text" id="searchInput" class="form-control" aria-describedby="searchHelpInline" placeholder="Search...">
            <button class="btn btn-primary" onclick="searchBerita()"><i class="bi bi-search"></i></button>
        </div>
        <form id="bulkDeleteForm" action="{{ route('linkmod.bulk_delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mb-3" onclick="return confirm('Apakah Anda yakin ingin menghapus item yang dipilih?')">Hapus yang Dipilih</button>
            <table class="table table-responsive table-bordered table-hover table-striped" style="margin-top: 2rem;">
                <thead>
                    <tr>
                        <th width="1%"><input type="checkbox" id="selectAll"></th>
                        <th width="15%">Judul</th>
                        <th width="15%">Link</th>
                        <th width="13%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($linkmod as $index => $repo)
                    <tr>
                        <td><input type="checkbox" name="ids[]" value="{{ $repo->id }}"></td>
                        <td>{{ $repo->judullinkmod }}</td>
                        <td><a href="{{ $repo->linkdrivemod }}" target="_blank">{{ $repo->linkdrivemod }}</a></td>
                        <td>
                            <a href="{{ route('linkmod.editlinkmod', $repo->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil-square" style="color: azure"></i>
                            </a>
                            <a href="{{ route('linkmod.deletelinkmod', $repo->id) }}" class="btn btn-danger" style="color: azure">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        <div class="d-flex justify-content-center">
            {{ $linkmod->links() }}
        </div>
    </div>
</div>
</section>
<script>
    function searchBerita() {
        var keyword = document.getElementById('searchInput').value;
        window.location.href = "{{ route('linkmod.show_by_adminlinkshow') }}?search=" + keyword;
    }

    document.getElementById('selectAll').onclick = function() {
        var checkboxes = document.querySelectorAll('input[name="ids[]"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    };
</script>
@endsection
