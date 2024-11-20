@extends('layouts.layoutsadmin')

@section('content')
    <style>
        .card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        .card-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #333;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
        }

        .display-4 {
            font-size: 2rem;
        }
    </style>

    <section class="gradient-bg py-1">
        <div class="container-fluid p-5 text-center mt-4">
            <h2 class="display-4 mt-3">Repository</h2>
        </div>
    </section>
    <section class="py-2">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                <div class="col">
                    <div class="card h-100 p-3">
                        <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                            src="{{ asset('icon/ms5.png') }}" alt="People Development Manager">
                        <div class="card-body">
                            <h4 class="card-title text-center">Method Of Development</h4>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <a class="btn btn-secondary" href="/materiadmin">View details &raquo;</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 p-3">
                        <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                            src="{{ asset('icon/ms2.png') }}" alt="Operation General Manager">
                        <div class="card-body">
                            <h4 class="card-title text-center">Subject Matter Expert</h4>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <a class="btn btn-secondary" href="/materiadminmodogm">View details &raquo;</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 p-3">
                        <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                            src="{{ asset('icon/ms10.png') }}" alt="Ware House">
                        <div class="card-body">
                            <h4 class="card-title text-center">General Learning</h4>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <a class="btn btn-secondary" href="/generallearnadmin">View details &raquo;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div style="height: 80px;"></div>
@endsection
