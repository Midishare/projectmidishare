@extends('layouts.layoutsadmin')

@section('content')
    <section>
        <style>
            /* Gaya CSS tambahan */
            .back-button {
                margin-top: 1rem;
                /* Menambahkan margin-top untuk jarak antara judul dan navbar */
            }

            @media (max-width: 768px) {
                .gradient-bg.py-5 {
                    padding-top: 2rem;
                    /* Penyesuaian padding atas untuk tampilan responsif */
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
            <div class="container-fluid p-4 d-flex align-items-center justify-content-between">
                <a href="javascript:history.back()" class="btn back-button">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <div class="container text-center mt-3">
                    <h2>COP</h3>
                        <div></div> <!-- Placeholder div to balance the flex container -->
                </div>
        </section>


        <div class="container text-center mt-4">
            <section class="py-1">
                <div class="container">
                    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                        <!-- MDP Card -->
                        <div class="col">
                            <div class="card h-100 p-3">
                                <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                                    src="{{ asset('icon/ms5.png') }}" alt="copfresh">
                                <div class="card-body">
                                    <h4 class="card-title text-center">Cop Fresh</h4>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <a class="btn btn-secondary" href="{{ route('admin.copfresh.index') }}">View details
                                        &raquo;</a>
                                </div>
                            </div>
                        </div>
                        <!-- DP Card -->
                        <div class="col">
                            <div class="card h-100 p-3">
                                <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                                    src="{{ asset('icon/ms2.png') }}" alt="Cop Inofest">
                                <div class="card-body">
                                    <h4 class="card-title text-center">Cop Inofest</h4>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <a class="btn btn-secondary" href="{{ route('admin.copinofest.index') }}">View details
                                        &raquo;</a>
                                </div>
                                {{-- admin.Cop Inofest.index --}}
                            </div>
                        </div>
                        <!-- IP Card -->
                        <div class="col">
                            <div class="card h-100 p-3">
                                <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                                    src="{{ asset('icon/ms10.png') }}" alt="COP Development Program ">
                                <div class="card-body">
                                    <h4 class="card-title text-center">COP Development Program</h4>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <a class="btn btn-secondary" href="{{ route('admin.copdevprog.index') }}">View details
                                        &raquo;</a>
                                </div>
                                {{-- admin.copdevelopmentprogram.index --}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100 p-3">
                                <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                                    src="{{ asset('icon/literasifinancial.png') }}" alt="Cop Trainer House">
                                <div class="card-body">
                                    <h4 class="card-title text-center">Cop Trainer House</h4>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <a class="btn btn-secondary" href="{{ route('admin.copfresh.index') }}">View
                                        details
                                        &raquo;</a>
                                </div>
                                {{-- admin.coptrainerhouse.index --}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100 p-3">
                                <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                                    src="{{ asset('icon/webinar.png') }}" alt="copkomunitasprapensiun ">
                                <div class="card-body">
                                    <h4 class="card-title text-center">Cop Komunitas Prapensiun </h4>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <a class="btn btn-secondary" href="{{ route('admin.copfresh.index') }}">View details
                                        &raquo;</a>
                                </div>
                                {{-- admin.copkomunitasprapensiun .index --}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        {{-- <div class="container text-center">
            <div class="row row-cols-1 row-cols-md-2 g-4 justify-content-center">
                <div class="col">
                    <div class="card h-100">
                        <img class="bd-placeholder-img rounded-circle mx-auto" width="180" height="180"
                            src="{{ asset('icon/dokumen.png') }}" alt="Operation General Manager">
                        <div class="card-body">
                            <h2 class="card-title">Materi Dokumen</h2>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-secondary" href="{{ route('admin.ino.materi') }}"
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
                            <a class="btn btn-secondary" href="{{ route('admin.ino.video') }}">Views details &raquo;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>

    <div style="height: 100px;"></div>
@endsection
