@extends('layouts.layouts')

@section('content')
    <style>
        .card-title a {
            color: black;
            text-decoration: none;
        }

        .card-title a:hover {
            text-decoration: underline;
        }

        .card {
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
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
    </style>


    <section class="gradient-bg py-5">
        <div class="container-fluid p-4 d-flex align-items-center justify-content-between">
            <a href="javascript:history.back()" class="btn back-button">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="container text-center">
            <h4>Repository Knowledge OGM</h4>
        </div>
        </div>
    </section>

    <section style="margin-top: 0.25rem;">
        <div class="container">
            <div class="row align-items-center justify-content-end">
                <div class="col-auto">
                    <div class="col-auto">
                        <form action="{{ route('knowledgeogm.showkmogm') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                    aria-describedby="searchHelpInline" placeholder="Search...">
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
                @foreach ($repositorykmogm as $repo)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('storage/gambar/' . $repo->gambarrepoogm) }}"
                                alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title text-dark">
                                    <a href="{{ asset('storage/dokumen/' . $repo->dokumenfilerepoogm) }}"
                                        target="_blank">{{ $repo->judulrepoogm }}</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    {{ $repositorykmogm->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
