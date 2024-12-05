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
            <h2>Belajar Mandiri All</h2>
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
                            <h4 class="card-title text-center">Belajar Mandiri</h4>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <a class="btn btn-secondary" href="{{ route('belajarmandiri.show') }}">View details &raquo;</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 p-3">
                        <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                            src="{{ asset('icon/ms2.png') }}" alt="Operation General Manager">
                        <div class="card-body">
                            <h4 class="card-title text-center">Buku Pintar WH</h4>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <a class="btn btn-secondary" href="{{ route('bukpin.index') }}">View details &raquo;</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 p-3">
                        <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                            src="{{ asset('icon/ms10.png') }}" alt="Ware House">
                        <div class="card-body">
                            <h4 class="card-title text-center">Papan Ilmu Toko</h4>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <a class="btn btn-secondary" href="">View details &raquo;</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 p-3">
                        <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                            src="{{ asset('icon/ms10.png') }}" alt="Ware House">
                        <div class="card-body">
                            <h4 class="card-title text-center">Standard Obat - Obatan</h4>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <a class="btn btn-secondary" href="{{ route('healthcareusers') }}">View details &raquo;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div style="height: 80px;"></div>
@endsection
