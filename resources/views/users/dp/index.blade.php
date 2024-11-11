@extends('layouts.layouts')

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

            .copyright-popup {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: white;
                padding: 2rem;
                border-radius: 10px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
                z-index: 1000;
                max-width: 90%;
                width: 400px;
            }

            .popup-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            /* Disable text selection */
            .card-body {
                user-select: none;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
            }

            .bg-midi {
                color: white;
                background-color: #E62323;
            }
        </style>

        <div id="copyrightPopup" class="copyright-popup">
            <h4 class="mb-3">Peringatan!</h4>
            <img class="" src="{{ asset('icon/attention.png') }}" width="150" alt="attention logo">
            <p>Materi ini dilindungi hak cipta. Dilarang keras untuk:</p>
            <ul class="text-left mb-4">
                <li>Menyalin (copy) materi</li>
                <li>Mendistribusikan ulang</li>
                <li>Memodifikasi tanpa izin</li>
            </ul>
            <button onclick="acceptWarning()" class="btn bg-midi">Saya Mengerti</button>
        </div>
        <div id="popupOverlay" class="popup-overlay"></div>

        <section class="gradient-bg py-5">
            <div class="container-fluid row p-4 d-flex align-items-center justify-content-between">
                <a href="javascript:history.back()" class="btn back-button col-12">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <div class="container text-center mt-3 col-12">
                    <h2>DP - Pilih Materi</h3>
                        <div></div> <!-- Placeholder div to balance the flex container -->
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
                            {{-- <p class="card-text">Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p> --}}
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-secondary" href="{{ route('dp.materi') }}"
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
                            {{-- <p class="card-text">Another exciting bit of representative placeholder content. This time, we've moved on to the second column.</p> --}}
                        </div>
                        <div class="card-footer">
                            {{--             <a href="{{ route('mdp.video') }}" class="btn btn-secondary btn-lg">Video</a> --}}
                            <a class="btn btn-secondary" href="{{ route('dp.video') }}">Views details &raquo;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Show popup when page loads
            document.addEventListener('DOMContentLoaded', function() {
                const hasSeenWarning = localStorage.getItem('hasSeenCopyrightWarning');
                if (!hasSeenWarning) {
                    showPopup();
                }
            });

            // Prevent right-click
            document.addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });

            // Prevent copy
            document.addEventListener('copy', function(e) {
                e.preventDefault();
                return false;
            });

            // Prevent cut
            document.addEventListener('cut', function(e) {
                e.preventDefault();
                return false;
            });

            // Show popup function
            function showPopup() {
                document.getElementById('copyrightPopup').style.display = 'block';
                document.getElementById('popupOverlay').style.display = 'block';
            }

            // Close popup function
            function acceptWarning() {
                localStorage.setItem('hasSeenCopyrightWarning', 'true');
                document.getElementById('copyrightPopup').style.display = 'none';
                document.getElementById('popupOverlay').style.display = 'none';
            }

            // Detect keyboard shortcuts for copy
            document.addEventListener('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && (e.key === 'c' || e.key === 'C')) {
                    e.preventDefault();
                    showPopup();
                }
            });
        </script>

    </section>

    <div style="height: 100px;"></div> <!-- Spasi antara konten dan footer -->
@endsection
