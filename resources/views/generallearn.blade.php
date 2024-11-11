@extends('layouts.layouts')

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

    <!-- Main Section -->

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
                                    <a class="btn btn-secondary" href="{{ route('ikt.index') }}">View details &raquo;</a>
                                </div>
                            </div>
                        </div>
                        <!-- DP Card -->
                        <div class="col">
                            <div class="card h-100 p-3">
                                <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                                    src="{{ asset('icon/ms2.png') }}" alt="MVP">
                                <div class="card-body">
                                    <h4 class="card-title text-center">MVP</h4>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <a class="btn btn-secondary" href="{{ route('mvp.index') }}">View details &raquo;</a>
                                </div>
                            </div>
                        </div>
                        <!-- IP Card -->
                        <div class="col">
                            <div class="card h-100 p-3">
                                <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                                    src="{{ asset('icon/ms10.png') }}" alt="inofest">
                                <div class="card-body">
                                    <h4 class="card-title text-center">COP</h4>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <a class="btn btn-secondary" href="{{ route('ino.index') }}">View details &raquo;</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100 p-3">
                                <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                                    src="{{ asset('icon/literasifinancial.png') }}" alt="financial literasi">
                                <div class="card-body">
                                    <h4 class="card-title text-center">Financial Literasi</h4>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <a class="btn btn-secondary" href="{{ route('finlit.index') }}">View details &raquo;</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100 p-3">
                                <img class="bd-placeholder-img rounded-circle mx-auto" width="200" height="150"
                                    src="{{ asset('icon/webinar.png') }}" alt="webinar">
                                <div class="card-body">
                                    <h4 class="card-title text-center">Webinar</h4>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <a class="btn btn-secondary" href="{{ route('webinar.index') }}">View details
                                        &raquo;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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

    <!-- Spacer -->
    <div style="height: 60px;"></div>
@endsection
