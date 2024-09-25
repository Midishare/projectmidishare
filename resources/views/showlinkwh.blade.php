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
    </style>
    <div style="margin-top: 7rem;">
        <h2 class="text-center">List Link Dokumen Warehouse</h2>
        @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <div class="col-md-12 bg-white p-4">
            <a href="{{ route('linkwh.addlinkwh') }}">
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
            <form id="deleteForm" method="POST" action="{{ route('linkwh.deleteSelectedwh') }}">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger mb-3">Hapus Terpilih</button>
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
                        @foreach($linkwh as $index => $repo)
                        <tr>
                            <td><input type="checkbox" name="selectedItems[]" value="{{ $repo->id }}"></td>
                            <td>{{ $index + 1}}</td>
                            <td>{{ $repo->judullinkwh }}</td>
                            <td><a href="{{ $repo->linkdrivewh }}" target="_blank">{{ $repo->linkdrivewh }}</a></td>
                            <td>
                                <a href="{{ route('linkwh.editlinkwh', $repo->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil-square" style="color: azure"></i>
                                </a>
                                <a href="{{ route('linkwh.deletelinkwh', $repo->id) }}" class="btn btn-danger" style="color: azure">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            <div class="d-flex justify-content-center">
                {{ $linkwh->links() }}
            </div>
        </div>
    </div>
</section>
<script>
    function searchBerita() {
        var keyword = document.getElementById('searchInput').value;
        window.location.href = "{{ route('linkwh.show_by_adminlinkwhshow') }}?search=" + keyword;
    }

    // Function to toggle select all checkboxes
    document.getElementById("selectAll").onclick = function() {
        var checkboxes = document.getElementsByName("selectedItems[]");
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    };
</script>
@endsection
