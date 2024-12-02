@extends('layouts.layoutsadmin')

@section('content')
    <div class="py-5" style="margin-top: 100px;">
        <div class="container">
            <div class="bg-white shadow">
                <div class="bg-success rounded text-white">
                    <div class="p-4 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="h4 mb-0 font-weight-bold">Standarisasi obat</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col p-4 pb-0">
                            <img src="{{ asset('icon/welcomealfamidi.png') }}" alt="Delivery Person" class="rounded"
                                style="object-fit: cover; width: 100%;">
                        </div>
                        <div class="col p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="h5 font-weight-bold">Delivery to your doorstep</h2>
                                    <p class="mb-0">Online medicine delivery is the process of ordering medications
                                        through a
                                        website or app and having them delivered to your doorstep.</p>
                                </div>
                                <div class="col-md-6">
                                    <h2 class="h5 font-weight-bold">100% Genuine Medicines</h2>
                                    <p class="mb-0">We guarantee that all the medicines we deliver are 100% genuine and of
                                        the
                                        highest quality.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-4 justify-content-betwen">
                    <div class="row container">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('icon/vitamin.jpg') }}" alt="Bone & Joint Care" class="w-5 rounded"
                                style="max-height: 180px; object-fit: cover;">
                            <h3 class="h6 font-weight-bold mt-2">Vitamin</h3>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('icon/cough.jpg') }}" alt="Liver Care" class="w-5 rounded"
                                style="max-height: 180px; object-fit: cover;">
                            <h3 class="h6 font-weight-bold mt-2">Batuk & Flu</h3>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('icon/fever.jpg') }}" alt="Respiratory Care" class="w-5 rounded"
                                style="max-height: 180px; object-fit: cover;">
                            <h3 class="h6 font-weight-bold mt-2">Demam & Sakit Kepala</h3>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('icon/ms10.png') }}" alt="Eye Care" class="w-5 rounded"
                                style="max-height: 180px; object-fit: cover;">
                            <h3 class="h6 font-weight-bold mt-2">Tetes mata</h3>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('icon/ms10.png') }}" alt="Eye Care" class="w-5 rounded"
                                style="max-height: 180px; object-fit: cover;">
                            <h3 class="h6 font-weight-bold mt-2">Tetes Telinga</h3>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('icon/ms10.png') }}" alt="Eye Care" class="w-5 rounded"
                                style="max-height: 180px; object-fit: cover;">
                            <h3 class="h6 font-weight-bold mt-2">Lambung</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
