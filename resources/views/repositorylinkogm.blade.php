@extends('layouts.layouts')

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
                opacity: 2;
            }
        }

        .card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }

        .btn-secondary:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        .back-button {
            position: absolute;
            top: 90px;
            left: 20px;
        }

        .judul {
            font-size: 1.5rem;
        }
    </style>

    <section class="gradient-bg py-5">
        <div class="container-fluid p-4 text-center mt-4">
            <a href="javascript:history.back()" class="btn back-button" style="margin-right: 20px;">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <h2>Materi Pembelajaran Operation General Manager</h2>
        </div>
    </section>

    <div class="container text-center animated fadeIn">
        <div class="row row-cols-1 row-cols-md-2 g-8 justify-content-center align-items-center">
            <div class="col">
                <div class="card h-100">
                    <img class="bd-placeholder-img rounded-circle mx-auto" width="180" height="180"
                        src="{{ asset('icon/web1.png') }}" alt="Operation General Manager">
                    <div class="card-body">
                        <h2 class="card-title">Dokumen</h2>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-secondary" href="{{ route('knowledgeogm.showkmogm') }}">View details &raquo;</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img class="bd-placeholder-img rounded-circle mx-auto" width="180" height="180"
                        src="{{ asset('icon/gdrive.png') }}" alt="Operation General Manager">
                    <div class="card-body">
                        <h2 class="card-title">Link Dokumen</h2>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-secondary" href="{{ route('linkogm.showlinkogm') }}">View details &raquo;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 60px;"></div>
@endsection
