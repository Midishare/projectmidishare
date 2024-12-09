@extends($layout)

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
            font-size: 2rem;
        }

        .text-dark {
            color: #343a40;
        }
    </style>

    <div class="container-fluid p-3 bg-white text-dark text-center mt-4 animated fadeIn">
    </div>

    <section class="gradient-bg py-1">
        <div class="container-fluid p-4 text-center mt-4">
            <a href="javascript:history.back()" class="btn back-button" style="margin-right: 20px;">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <h2>Cek</h2>
        </div>
    </section>
    <div class="container text-center mt-4 animated fadeIn">
        <div class="row row-cols-1 row-cols-md-2 g-8 justify-content-center align-items-center">
            <div class="col">
                <div class="card h-100">
                    <img class="bd-placeholder-img rounded-circle mx-auto p-2" width="" height="180"
                        src="{{ asset('icon/obat.jpg') }}" alt="Operation General Manager">
                    <div class="card-body">
                        <h2 class="card-title">Cek Gula</h2>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-secondary" href="{{ route('blood-sugar.create') }}">View details
                            &raquo;</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img class="bd-placeholder-img rounded-circle mx-auto p-2" width="" height="180"
                        src="{{ asset('icon/cholesterol.png') }}" alt="Operation General Manager">
                    <div class="card-body">
                        <h2 class="card-title">Cek Kolestrol</h2>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-secondary" href="{{ route('cholesterol.create') }}">View details
                            &raquo;</a>
                    </div>
                </div>
            </div>
            <div class="col m-2">
                <div class="card h-100">
                    <img class="bd-placeholder-img rounded-circle mx-auto p-2" width="" height="180"
                        src="{{ asset('icon/cholesterol.png') }}" alt="Operation General Manager">
                    <div class="card-body">
                        <h2 class="card-title">Cek Asam Urat</h2>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-secondary" href="{{ route('uricacid.create') }}">View details
                            &raquo;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 60px;"></div>
@endsection
