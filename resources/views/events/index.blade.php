@extends('layouts.layoutsadmin')

@section('content')
    <style>
        .animated {
            animation-duration: 0.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>

    <div style="margin-top: 7rem;" class="animated fadeIn">
        <h2 class="text-center">List Event</h2>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <div class="col-md-12 bg-white p-4">
            <div class="row">
                <div class="col-md-10">
                    <a href="{{ route('events.create') }}">
                        <button class="btn btn-primary mb-3"><strong>+</strong> Tambah Event</button>
                    </a>
                </div>
                <div class="col-md-2 text-right">
                    <!-- Form Pencarian -->
                    <div class="col-auto">
                        <form action="{{ route('events.admin') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                    aria-describedby="searchHelpInline" placeholder="Search...">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <form id="bulkDeleteFormEvent" method="POST" action="{{ route('events.bulk_delete') }}">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger mt-4" onclick="confirmBulkDeleteEvent()">Hapus yang
                    dipilih</button>

                <table class="table table-responsive table-bordered table-hover table-striped" style="margin-top: 1rem;">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAllEvent"></th>
                            <th>No.</th>
                            <th width="22%">Judul</th>
                            <th>Deskripsi</th>
                            <th width="13%">Tanggal Publish</th>
                            <th width="13%">Gambar</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $i => $event)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{ $event->id }}"></td>
                                <td>{{ $events->firstItem() + $i }}</td>
                                <td>{{ $event->title }}</td>
                                <td>{!! $event->description !!}</td>
                                <td>{{ $event->created_at }}</td>
                                <td><img src="{{ asset('storage/event_images/' . $event->image) }}" alt="Gambar Event"
                                        style="max-width: 100px;"></td>
                                <td>
                                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">
                                        <i class="bi bi-pencil-square" style="color: azure"></i>
                                    </a>
                                    <a href="javascript:void(0);" onclick="confirmDeleteEvent({{ $event->id }})"
                                        class="btn btn-danger" style="color: azure">
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
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function searchEvent() {
            const searchTerm = document.getElementById('searchInput').value;
            window.location.href = `{{ route('events.show') }}?search=${encodeURIComponent(searchTerm)}`;
        }
        document.getElementById('selectAllEvent').addEventListener('click', function(event) {
            var checkboxes = document.querySelectorAll('input[name="ids[]"]');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        });

        function confirmBulkDeleteEvent() {
            if (confirm("Apakah Anda yakin ingin menghapus event yang dipilih?")) {
                document.getElementById('bulkDeleteFormEvent').submit();
            }
        }

        function confirmDeleteEvent(id) {
            Swal.fire({
                title: 'Ingin Menghapus Event Ini?',
                text: "Apakah anda yakin ingin menghapus event ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('events.destroy', '') }}/" + id;
                }
            });
        }
    </script>
@endsection
