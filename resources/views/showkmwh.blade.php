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

    /* Efek hover untuk tombol tambah */
    .btn-primary:hover {
        transform: scale(1.05); /* Memperbesar tombol saat dihover */
        transition: transform 0.3s ease;
    }

    /* Efek hover untuk tombol edit dan hapus */
    .btn-warning:hover, .btn-danger:hover {
        filter: brightness(1.2); /* Meningkatkan kecerahan tombol saat dihover */
        transition: filter 0.3s ease;
    }
    .back-button {
        position: absolute;
        top: 100px; /* Menyesuaikan tinggi dari bagian atas */
        left: 20px;
        z-index: 999;
    }
</style>

<section class="animated fadeIn">
    <div style="margin-top: 7rem;">
        <h2 class="text-center">List Repository Warehouse</h2>
        @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <div class="col-md-12 bg-white p-4">
            
            <div class="row justify-content-start mb-3">
                <div class="col-auto">
                    <a href="{{ route('knowledgewh.addkmwh') }}">
                        <button class="btn btn-primary"><strong>+</strong>Tambah</button>
                    </a>
                </div>
            </div>

            <button class="btn btn-danger mb-3" id="delete-selected-btn">Hapus Semua</button>
            <!-- Form Pencarian -->
            <div class="row g-2 align-items-center justify-content-end">
                <div class="col-auto">
                    <input type="text" id="searchInput" class="form-control" aria-describedby="searchHelpInline"
                        placeholder="Search...">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" onclick="searchBerita()"><i class="bi bi-search"></i></button>
                </div>
            </div>
            <table class="table table-responsive table-bordered table-hover table-striped" style="margin-top: 2rem;">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="select-all-checkbox">
                        </th>
                        <th width="1%">No.</th>
                        <th width="22%">Judul</th>
                        <th>Gambar</th>
                        <th width="13%">File Dokumen</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($repositorykmwh as $index => $repo)
                    <tr>
                        <td>
                            <input type="checkbox" class="data-checkbox" value="{{ $repo->id }}">
                        </td>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $repo->judulrepowh }}</td>
                        <td>
                            @if ($repo->gambarrepowh)
                            <img src="{{ asset('storage/gambar/' . $repo->gambarrepowh) }}"
                                alt="Gambar Repository" style="max-width: 100px; max-height: 100px;">
                            @else
                            <span>Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>
                            @if (pathinfo($repo->dokumenfilerepowh, PATHINFO_EXTENSION) == 'pdf')
                            <a href="{{ asset('storage/dokumen/' . $repo->dokumenfilerepowh) }}" target="_blank">Lihat
                                PDF</a>
                            @elseif (in_array(pathinfo($repo->dokumenfilerepowh, PATHINFO_EXTENSION), ['doc', 'docx']))
                            <a href="{{ asset('storage/dokumen/' . $repo->dokumenfilerepowh) }}" target="_blank">Unduh
                                DOC</a>
                            @elseif (in_array(pathinfo($repo->dokumenfilerepowh, PATHINFO_EXTENSION), ['ppt',
                            'pptx']))
                            <a href="{{ asset('storage/dokumen/' . $repo->dokumenfilerepowh) }}"
                                target="_blank">Lihat PPT</a>
                            @else
                            <span>Format tidak didukung</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('/editkmwh/' . $repo->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil-square" style="color: azure"></i>
                            </a>
                            <a href="{{ url('/deletekmwh/' . $repo->id) }}" class="btn btn-danger"
                                style="color: azure">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $repositorykmwh->links() }}
            </div>
        </div>
    </div>
</section>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Fungsi untuk memilih atau tidak memilih semua checkbox
    $('.select-all-checkbox').click(function () {
        $('.data-checkbox').prop('checked', this.checked);
    });

    // Fungsi untuk menangani klik tombol "Hapus Semua"
    $('#delete-selected-btn').click(function () {
        var selectedIds = [];

        // Loop melalui setiap checkbox yang dipilih
        $('.data-checkbox:checked').each(function () {
            selectedIds.push($(this).val());
        });

        // Kirim request penghapusan ke server
        if (selectedIds.length > 0) {
            if (confirm("Anda yakin ingin menghapus data terpilih?")) {
                var form = $('<form>', {
                    'action': '{{ route('deletekmwh.bulkDelete') }}',
                    'method': 'POST',
                    'style': 'display:none;'
                }).append(
                    $('<input>', {
                        'name': '_method', 
                        'value': 'DELETE',
                        'type': 'hidden'
                    }),
                    $('<input>', {
                        'name': '_token',
                        'value': '{{ csrf_token() }}',
                        'type': 'hidden'
                    })
                ).appendTo('body');
                
                selectedIds.forEach(function (id) {
                    form.append(
                        $('<input>', {
                            'name': 'ids[]',
                            'value': id,
                            'type': 'hidden'
                        })
                    );
                });
                
                form.submit();
            }
        } else {
            alert('Pilih setidaknya satu data untuk dihapus.');
        }
    });

    function searchBerita() {
        var keyword = document.getElementById('searchInput').value;
        window.location.href = "{{ route('knowledgewh.show_by_adminkmwhshow') }}?search=" + keyword;
    }
</script>
@endsection

