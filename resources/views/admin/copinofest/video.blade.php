@extends('layouts.layoutsadmin')

@section('content')
    <style>
        .container {
            margin-top: 7rem;
        }

        .search-wrapper {
            display: flex;
            align-items: stretch;
            max-width: 350px;
            margin-left: auto;
        }

        .search-input {
            flex: 1;
            padding: 12px 16px;
            font-size: 14px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            outline: none;
            transition: all 0.2s ease;
            width: 100%;
            padding-right: 40px;
        }

        .search-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .search-button {
            position: absolute;
            right: 2px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
        }

        .search-button:hover {
            color: #2563eb;
        }

        .search-icon {
            display: inline-block;
            width: 20px;
            height: 20px;
            background: transparent;
            border: 2px solid currentColor;
            border-radius: 50%;
            position: relative;
        }

        .search-icon::after {
            content: '';
            position: absolute;
            top: 14px;
            left: 14px;
            width: 7px;
            height: 2px;
            background: currentColor;
            transform: rotate(45deg);
            transform-origin: left center;
        }

        .search-button:hover .search-icon {
            color: #2563eb;
        }
    </style>
    <div class="container">
        <h2 class="text-center">Video Cop Inofest</h2>
        <div class="col-md-12 bg-white p-4">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('admin.videocopinofest.video.create') }}" class="btn btn-primary">Add Video</a>
                </div>
                <div class="col-md-6 text-right">
                    <div class="row g-2 align-items-center justify-content-end">
                        <form action="{{ route('admin.videocopinofest.video') }}" method="GET">
                            <div class="search-wrapper" style="position: relative;">
                                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                                    class="search-input">
                                <button type="submit" class="search-button">
                                    <span class="search-icon"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <form id="bulkDeleteForm" method="POST" action="{{ route('admin.videocopinofest.video.bulkDelete') }}">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger mt-4" onclick="confirmBulkDelete()">Hapus yang dipilih</button>

            <table class="table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>Title</th>
                        <th>Video Link</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($videocopinofest as $video)
                        <tr>
                            <td><input type="checkbox" name="video_ids[]" value="{{ $video->id }}"></td>
                            <td>{{ $video->title }}</td>
                            <td><a href="{{ $video->video_link }}" target="_blank">View Video</a></td>
                            <td><img src="{{ Storage::url($video->image_path) }}" width="100"></td>
                            <td>
                                <a href="{{ route('admin.videocopinofest.video.edit', $video->id) }}"
                                    class="btn btn-info">Edit</a>
                                <button type="button" class="btn btn-danger"
                                    onclick="confirmDelete({{ $video->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        {{ $videocopinofest->links() }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmBulkDelete() {
            Swal.fire({
                title: 'Ingin Menghapus Video Yang Dipilih?',
                text: "Apakah anda yakin ingin menghapus video yang dipilih?",
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

        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('selectAll');
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('click', function(e) {
                    const checkboxes = document.querySelectorAll('input[name="video_ids[]"]');
                    checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
                });
            }
        });

        function confirmDelete(videoId) {
            Swal.fire({
                title: 'Hapus Video Ini?',
                text: "Apakah Anda yakin ingin menghapus video ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.action = `/admin/copinofest/video/${videoId}`;
                    form.method = 'POST';

                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    form.appendChild(csrfInput);

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection
