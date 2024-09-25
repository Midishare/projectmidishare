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
    .back-button {
        position: absolute;
        top: 80px;
        left: 20px;
        z-index: 999;
    }
</style>

<div style="margin-top: 7rem;" class="animated fadeIn">
    {{-- <a href="javascript:history.back()" class="btn back-button" style="margin-right: 20px;">
        <i class="bi bi-arrow-left"></i> Kembali
    </a> --}}
    <h2 class="text-center">List Repository People Development Manager</h2>
    @if($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{$message}}</strong>
    </div>
    @endif
    <div class="col-md-12 bg-white p-4">
        <a href="{{ route('knowledge.addmandiri') }}">
            <button class="btn btn-primary mb-3"><strong>+</strong>Tambah</button>
        </a>
        <div class="row g-2 align-items-center" style="margin-top: 1rem;">
            <div class="col"></div> <!-- Kolom kosong untuk memindahkan ke kanan -->
            <div class="col-auto">
                <!-- Form Pencarian -->
                <form action="{{ route('knowledge.show_by_adminkmshow') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" id="searchInput" class="form-control" aria-describedby="searchHelpInline" placeholder="Search...">
                        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <form id="bulkDeleteForm" action="{{ route('knowledge.bulk_delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mb-3" onclick="return confirm('Apakah Anda yakin ingin menghapus item yang dipilih?')">Hapus yang Dipilih</button>
            <table class="table table-responsive table-bordered table-hover table-striped" style="margin-top: 1rem;">
                <thead>
                    <tr>
                        <th width="1%"><input type="checkbox" id="selectAll"></th>
                        <th width="1%">No.</th>
                        <th width="22%">Judul</th>
                        <th>Gambar</th>
                        <th width="13%">File Dokumen</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($repositorykm as $index => $repo)
                    <tr>
                        <td><input type="checkbox" name="ids[]" value="{{ $repo->id }}"></td>
                        <td>{{ $repositorykm->firstItem() + $index }}</td>
                        <td>{{ $repo->judul }}</td>
                        <td>
                            @if ($repo->gambar)
                            <img src="{{ asset('storage/gambar/' . $repo->gambar) }}" alt="Gambar Repository" style="max-width: 100px; max-height: 100px;">
                            @else
                            <span>Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>
                            @if (pathinfo($repo->dokumenfile, PATHINFO_EXTENSION) == 'pdf')
                            <a href="{{ asset('storage/dokumen/' . $repo->dokumenfile) }}" target="_blank">Lihat Dokumen</a>
                            @elseif (in_array(pathinfo($repo->dokumenfile, PATHINFO_EXTENSION), ['doc', 'docx']))
                            <a href="{{ asset('storage/dokumen/' . $repo->dokumenfile) }}" target="_blank">Unduh DOC</a>
                            @elseif (in_array(pathinfo($repo->dokumenfile, PATHINFO_EXTENSION), ['ppt', 'pptx']))
                            <a href="{{ asset('storage/dokumen/' . $repo->dokumenfile) }}" target="_blank">Lihat PPT</a>
                            @else
                            <span>Format tidak didukung</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('/editkm/' . $repo->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil-square" style="color: azure"></i>
                            </a>
                            <a href="{{ url('/deletekm/' . $repo->id) }}" class="btn btn-danger" style="color: azure" onclick="confirmDelete('{{ $repo->id }}')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        <div class="d-flex justify-content-center">
            {{ $repositorykm->links() }}
        </div>
    </div>
</div>

<script>
    function searchRepository() {
        var keyword = document.getElementById('searchInput').value;
        window.location.href = "{{ route('knowledge.show_by_adminkmshow') }}?search=" + keyword;
    }

    function confirmDelete(id) {
        if (confirm("Apakah Anda yakin ingin menghapus repository ini?")) {
            window.location.href = "/deletekm/" + id;
        }
    }

    document.getElementById('selectAll').onclick = function() {
        var checkboxes = document.querySelectorAll('input[name="ids[]"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    };
</script>
@endsection
