@extends('layouts.layouts')

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
    </style>

    <section>
        <div class="container text-center p-5 mt-5">
            <h2>Repository</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
        </div>
    </section>
    <section class="py-1">
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
                            <a class="btn btn-secondary" href="{{ route('materimod') }}">View details &raquo;</a>
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
                            <a class="btn btn-secondary" href="{{ route('materiogm') }}">View details &raquo;</a>
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
                            <a class="btn btn-secondary" href="{{ route('generallearn') }}">View details &raquo;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div style="height: 80px;"></div>
@endsection
