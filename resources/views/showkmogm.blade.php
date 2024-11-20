@extends('layouts.layoutsadmin')

@section('content')
    <section>
        <style>
            .back-button {
                position: absolute;
                top: 100px;
                left: 20px;
                z-index: 999;
            }
        </style>
        <div style="margin-top: 7rem;">
            <h2 class="text-center">List Repository Operation General Manager</h2>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="col-md-12 bg-white p-4">
                <a href="{{ route('knowledgeogm.addkmogm') }}">
                    <button class="btn btn-primary mb-3"><strong>+</strong>Tambah</button>
                </a>
                <div class="row g-2 align-items-center justify-content-end">
                    <div class="col-auto">
                        <input type="text" id="searchInput" class="form-control" aria-describedby="searchHelpInline"
                            placeholder="Search...">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" onclick="searchBerita()"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <form id="deleteForm" method="POST" action="{{ route('knowledgeogm.deleteSelected') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mb-3 mt-3">Hapus Terpilih</button>
                    <table class="table table-responsive table-bordered table-hover table-striped"
                        style="margin-top: 2rem;">
                        <thead>
                            <tr>
                                <th width="5%"><input type="checkbox" id="select-all"></th>
                                <th width="1%">No.</th>
                                <th width="22%">Judul</th>
                                <th>Gambar</th>
                                <th width="13%">File Dokumen</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($repositorykmogm as $index => $repo)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="selectedItems[]" value="{{ $repo->id }}"
                                            class="select-item">
                                    </td>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $repo->judulrepoogm }}</td>
                                    <td>
                                        @if ($repo->gambarrepoogm)
                                            <img src="{{ asset('storage/gambar/' . $repo->gambarrepoogm) }}"
                                                alt="Gambar Repository" style="max-width: 100px; max-height: 100px;">
                                        @else
                                            <span>Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (pathinfo($repo->dokumenfilerepoogm, PATHINFO_EXTENSION) == 'pdf')
                                            <a href="{{ asset('storage/dokumen/' . $repo->dokumenfilerepoogm) }}"
                                                target="_blank">Lihat PDF</a>
                                        @elseif (in_array(pathinfo($repo->dokumenfilerepoogm, PATHINFO_EXTENSION), ['doc', 'docx']))
                                            <a href="{{ asset('storage/dokumen/' . $repo->dokumenfilerepoogm) }}"
                                                target="_blank">Unduh DOC</a>
                                        @elseif (in_array(pathinfo($repo->dokumenfilerepoogm, PATHINFO_EXTENSION), ['ppt', 'pptx']))
                                            <a href="{{ asset('storage/dokumen/' . $repo->dokumenfilerepoogm) }}"
                                                target="_blank">Lihat PPT</a>
                                        @else
                                            <span>Format tidak didukung</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/editkmogm/' . $repo->id) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil-square" style="color: azure"></i>
                                        </a>
                                        <a href="{{ url('/deletekmogm/' . $repo->id) }}" class="btn btn-danger"
                                            style="color: azure">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
                <div class="d-flex justify-content-center">
                    {{ $repositorykmogm->links() }}
                </div>
            </div>
        </div>
    </section>
    <script>
        function searchBerita() {
            var keyword = document.getElementById('searchInput').value;
            window.location.href = "{{ route('knowledgeogm.show_by_adminkmogmshow') }}?search=" + keyword;
        }

        document.getElementById('select-all').addEventListener('click', function(event) {
            const checkboxes = document.querySelectorAll('.select-item');
            checkboxes.forEach(checkbox => {
                checkbox.checked = event.target.checked;
            });
        });
    </script>
@endsection
