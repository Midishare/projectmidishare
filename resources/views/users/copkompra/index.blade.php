@extends('layouts.layouts')

@section('content')
    <section>
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

            .mt-4 {
                margin-top: 20px;
            }
        </style>
        <section class="gradient-bg py-5">
            <div class="container-fluid row p-4 d-flex align-items-center justify-content-between">
                <a href="javascript:history.back()" class="btn back-button col-12">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <div class="container text-center mt-3 col-12">
                    <h2>COP Komunitas Prapensiun - Pilih Materi</h3>
                        <div></div>
                </div>
            </div>
        </section>


        <div class="container text-center">
            <div class="row row-cols-1 row-cols-md-2 g-4 justify-content-center">
                <div class="col">
                    <div class="card h-100">
                        <img class="bd-placeholder-img rounded-circle mx-auto" width="180" height="180"
                            src="{{ asset('icon/dokumen.png') }}" alt="Operation General Manager">
                        <div class="card-body">
                            <h2 class="card-title">Materi Dokumen</h2>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-secondary" href="{{ route('copkompra.materi') }}"
                                class="btn btn-primary btn-lg">Views Details</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img class="bd-placeholder-img rounded-circle mx-auto" width="180" height="180"
                            src="{{ asset('icon/video player.png') }}" alt="Operation General Manager">
                        <div class="card-body">
                            <h2 class="card-title">Video</h2>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-secondary" href="{{ route('copkompra.video') }}">Views details &raquo;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div style="height: 100px;"></div>
@endsection
