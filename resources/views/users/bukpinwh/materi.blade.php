@extends('layouts.layouts')

@section('content')
    <section style="margin-top: 100px;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <h4>Buku Pintar WH</h4>
                </div>
                <div class="col-auto">
                    <form action="{{ route('bukpin.materi') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                placeholder="Search...">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container" style="margin-top: 2rem;">
            <div class="row">
                <div class="container">
                    <h1 class="text-center my-4">Pilih Buku</h1>
                    <div class="row">
                        @forelse ($bukupintarwh as $book)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    @if (is_string($book->file_paths))
                                        @php
                                            $filePaths = json_decode($book->file_paths);
                                        @endphp
                                        @if (isset($filePaths[0]))
                                            <img src="{{ asset($filePaths[0]) }}" alt="Image" class="w-full">
                                        @endif
                                    @elseif (is_array($book->file_paths))
                                        @if (isset($book->file_paths[0]))
                                            <img src="{{ asset($book->file_paths[0]) }}" alt="Image">
                                        @endif
                                    @endif
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $book->title }}</h5>
                                        <a href="{{ route('bukpin.materidetail', $book->id) }}" class="btn btn-primary">Baca
                                            Buku</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                <p>Tidak ada buku yang ditemukan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $bukupintarwh->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
    .card:hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .card-img-top {
        max-height: 200px;
        object-fit: cover;
    }
</style>
