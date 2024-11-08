<!-- In your index.blade.php or materi.blade.php -->
@extends('layouts.layouts')

@section('content')
<section style="margin-top: 100px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h4>Dokumen IP</h4>
            </div>
            <div class="col-auto">
                <form action="{{ route('ip.materi') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <select name="category" class="form-control mx-2" onchange="this.form.submit()">
                            <option value="">-- Semua Category --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container" style="margin-top: 2rem;">
        <div class="row">
            @foreach($dokumens as $dokumen)
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                <div class="card shadow-sm h-100 w-100 p-1">
                    <img class="card-img-top" src="{{ asset('storage/' . $dokumen->image_path) }}" alt="Card image cap" style="height: 200px; width: auto; object-fit: cover;">
                    <div class="card-body d-flex flex-row justify-content-between">
                        <h5 class="">
                            <a href="{{ $dokumen->link }}" target="_blank" class="news-title-link">{{ $dokumen->title }}</a>
                        </h5>
                    </div>
                    <p class="card-text ms-auto"><small class="text-muted">{{ \Carbon\Carbon::parse($dokumen->created_at)->format('d M Y') }}</small></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $dokumens->appends(request()->input())->links() }} <!-- Ensure pagination is working -->
            </div>
        </div>
    </div>
</section>

@endsection
