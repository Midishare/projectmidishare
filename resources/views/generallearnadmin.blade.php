@extends('layouts.layoutsadmin')

@section('content')
    <!-- Bootstrap and Custom Styles -->
    <style>
        /* Custom styles */
        .card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }
    </style>

    <!-- Main Section -->
    <section>
        <div class="container text-center p-5 mt-5">
            <h2>General Learning</h2>
        </div>
        <div class="container text-center mt-4">
            <section class="py-1">
                <div class="container">
                    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                        <!-- MDP Card -->
                        <div class="col">
                            <div class="card h-100 p-3">
                                <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                                    src="{{ asset('icon/ms5.png') }}" alt="IKT">
                                <div class="card-body">
                                    <h4 class="card-title text-center">IKT</h4>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <a class="btn btn-secondary" href="{{ route('admin.ikt.index') }}">View details
                                        &raquo;</a>
                                </div>
                            </div>
                        </div>
                        <!-- DP Card -->
                        <div class="col">
                            <div class="card h-100 p-3">
                                <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                                    src="{{ asset('icon/ms2.png') }}" alt="MVp">
                                <div class="card-body">
                                    <h4 class="card-title text-center">MVP</h4>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <a class="btn btn-secondary" href="{{ route('admin.mvp.index') }}">View details
                                        &raquo;</a>
                                </div>
                            </div>
                        </div>
                        <!-- IP Card -->
                        <div class="col">
                            <div class="card h-100 p-3">
                                <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                                    src="{{ asset('icon/ms10.png') }}" alt="Inofest">
                                <div class="card-body">
                                    <h4 class="card-title text-center">Inofest</h4>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <a class="btn btn-secondary" href="{{ route('admin.ino.index') }}">View details
                                        &raquo;</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100 p-3">
                                <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                                    src="{{ asset('icon/literasifinancial.png') }}" alt="Financial Literasi">
                                <div class="card-body">
                                    <h4 class="card-title text-center">Financial Literasi</h4>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <a class="btn btn-secondary" href="{{ route('admin.finlit.index') }}">View details
                                        &raquo;</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100 p-3">
                                <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                                    src="{{ asset('icon/webinar.png') }}" alt="Webinar">
                                <div class="card-body">
                                    <h4 class="card-title text-center">Webinar</h4>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <a class="btn btn-secondary" href="{{ route('admin.webinar.index') }}">View details
                                        &raquo;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <!-- Spacer -->
    <div style="height: 60px;"></div>
@endsection
