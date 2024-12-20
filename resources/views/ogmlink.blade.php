@extends('layouts.layouts')

@section('content')
    <style>
        .back-button {
            margin-top: 1rem;
        }

        @media (max-width: 768px) {
            .gradient-bg.py-5 {
                padding-top: 2rem;
            }
        }

        .card-title a {
            color: #007bff;
            text-decoration: none;
        }

        .card-title a:hover {
            text-decoration: underline;
        }

        .card {
            transition: transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .back-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        h4 {
            margin-top: 0.2rem;
            margin-bottom: 0;
        }

        .input-group {
            border: 1px solid #ced4da;
            border-radius: 5px;
            overflow: hidden;
        }

        .input-group input {
            border: none;
            box-shadow: none;
        }

        .input-group button {
            background-color: #007bff;
            border: none;
        }

        .input-group button:hover {
            background-color: #0056b3;
        }
    </style>

    <section class="gradient-bg py-5">
        <div class="container-fluid p-4 d-flex align-items-center justify-content-between">
            <a href="javascript:history.back()" class="btn back-button">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="container text-center">
            <h4>Materi SME</h4>
        </div>
    </section>

    <section style="margin-top: 0.25rem;">
        <div class="container">
            <div class="row align-items-center justify-content-end">
                <div class="col-auto">
                    <form action="{{ route('linkogm.showlinkogm') }}" method="GET" class="flex-grow-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" aria-describedby="searchHelpInline"
                                placeholder="Search...">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="container" style="margin-top: 2rem;">
        <div class="row">
            @foreach ($linkogm as $repo)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($repo->image_path)
                            <img src="{{ asset('storage/' . $repo->image_path) }}" class="card-img-top"
                                alt="{{ $repo->judullinkogm }}">
                        @else
                            <img src="{{ asset('images/default-image.png') }}" class="card-img-top" alt="Default Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-text text-dark p-2">
                                <a style="text-decoration: none" class="text-reset" href="{{ $repo->linkdriveogm }}"
                                    target="_blank">{{ $repo->judullinkogm }}</a>
                            </h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{ $linkogm->links() }}
    </section>
@endsection
