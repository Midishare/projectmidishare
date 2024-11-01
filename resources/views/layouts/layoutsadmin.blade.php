<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('icon/LogoMidishare.png')}}" type="image/x-icon">
    <title>Midishare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">      
    <link rel="stylesheet" href="{{asset('css.style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
        }


        .navbar-brand img {
            max-width: 100%;
            height: auto;
        }

        .navbar-nav .nav-link {
            color: #000000 !important; /* Warna teks navbar hitam */
        }

        .navbar-nav .nav-item {
            margin-right: 1rem;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link:focus,
        .navbar-nav .nav-link.active {
            color: #E62323 !important; /* Warna teks saat hover dan aktif */
            text-decoration: none; /* Menghapus underline default */
            border-bottom: 2px solid #E62323; /* Menambahkan garis bawah custom */
            padding-bottom: 2px; /* Jarak antara teks dan garis bawah */
        }

        .dropdown-item {
    color: #000000;
    padding: 0.5rem 1.5rem;
    transition: all 0.3s ease;
}
.nav-item.dropdown {
    position: relative; /* Ensure proper positioning context */
}

        .dropdown-menu .dropdown-item:hover,
        .dropdown-menu .dropdown-item:focus,
        .dropdown-menu .dropdown-item.active {
            background-color: #0056b3; /* Warna latar belakang dropdown saat hover dan aktif */
            color: #ffffff !important; /* Warna teks dropdown saat hover dan aktif */
        }
        .dropdown-menu {
            left: 0 !important; /* Override any other positioning */
    transform: none !important; /* Remove any transforms */
    margin-top: 0.5rem; /* Add a small gap between nav link and dropdown */
        }

        /* Glassmorphism navbar */
        .navbar-glass {
            
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        /* Navbar saat di-scroll */
        .navbar-scroll {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); /* Shadow lebih tajam */
            background-color: rgba(255, 255, 255, 0.2); /* Transparansi */
            backdrop-filter: blur(10px); /* Efek blur */
        }

        .custom-footer {
            background-color: #E62323; /* Warna latar belakang footer */
            color: #ffffff;
            padding: 1rem 0;
            text-align: center;
            width: 100%;
        }

        .footer-container {
            margin-top: auto;
        }

        .footer-logo {
            height: 4rem;
            width: 4rem;
        }

        .footer-text {
            text-align: left;
            width: 300px;
        }

        .footer-address {
            font-size: 14px;
            text-align: left;
        }
        .footer-copy{
            font-size: 14px;
            text-align: left;
        }

        .footer-links-about{
            text-align: center;
            margin-top: 65px;
        }
        
        .footer-links-about a{
            text-decoration: none;
            color: #ffffff;
        }

        .footer-links {
            text-align: right;
            margin-top: 65px;
        }
        .footer-links a{
            text-decoration: none;
            color: #ffffff
        }

        .social-icons a {
            text-decoration: none;
            color: white;
        }

        .loading-overlay {
            display: none;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #E62323;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @media (max-width: 768px) {
            .navbar-nav .nav-item {
                margin-right: 0;
                margin-bottom: 0.5rem;
            }

            .navbar-nav {
                flex-direction: column;
            }
            .navbar-glass {
            
            background-color: rgba(255, 255, 255, 0.7); /* Background lebih solid saat di-scroll */
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
            .navbar-nav .nav-link:hover,
            .navbar-nav .nav-link:focus,
            .navbar-nav .nav-link.active {
                color: #E62323 !important; /* Warna teks saat hover dan aktif */
                text-decoration: underline;
                text-underline-offset: 5px; /* Jarak antara teks dan underline */
                border-bottom: 0px; /* Menambahkan garis bawah custom */
                padding-bottom: 0px; /* Jarak antara teks dan garis bawah */
            }
            .dropdown-menu{
                margin-left: 50px !important;
            }
            .footer-links-about{
                text-align: left;
                margin-top: 65px;
            }
        
            .footer-links-about a{
                text-decoration: none;
                color: #ffffff;
            }
            .footer-links {
                text-align: left;
                margin-top: 65px;
            }
            .footer-links a{
                text-align: left;
                text-decoration: none;
                color: #ffffff
            }
        }

        
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg py-3 fixed-top navbar-glass">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> 
                <img src="{{asset('icon/logomidi.png')}}" height="24" width="110" alt="Logo"> 
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="col justify-content-center navbar-nav ms-auto mb-2 mb-lg-0">
                    @if (auth()->user()->hasRole('admin'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">Users</a>
                    </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cheklist</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.checklist.index') }}">MOD</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.gapknow.index') }}">GAP Knowledge</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('berita.show_by_admin') }}">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.admin') }}">Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.livestream') }}">Admin Livestream</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Repository
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('kmadmin') }}">Knowledge Management</a></li>
                            <li><a class="dropdown-item" href="{{ route('belajarmandiri.show_by_adminmandirishow') }}">Belajar Mandiri</a></li>
                        </ul>                            
                    </li>
                </ul>
                <div class="">
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link text-center fs-2"><i class="bi bi-power me-2"></i></button>
                    </form>
                </div>
            </div>                
        </div>
    </nav>
    <div class="content">
        <div id="loadingOverlay" class="loading-overlay">
            <div class="spinner"></div>
            <div><b>Mohon Tunggu...</b></div>
        </div>
        @yield('content') 
    </div>
    
    <footer class="custom-footer" style="margin-top: 200px;">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex justify-content-start align-items-center">
                        <img class="footer-logo" src="{{ asset('icon/logomidifooter.png') }}" alt="Logo">
                    </div> 
                    <p class="footer-text"><b>PT Midi Utama Indonesia, Tbk</b></p>
                    <p class="footer-address">Alfa Tower Lt 10 - 12, Jl Jalur Sutera Barat Kav 7-9 Alam<br>
                    Sutera, Panunggangan Timur, Pinang, Tangerang</p>
                    <p class="footer-copy">&copy; 2024 Midishare</p>
                </div>
                <div class="col-md-4 footer-links-about">
                    <p><b>Tentang Kami</b></p>
                    <p><a href="{{ route('berita.show') }}">News</a></p>
                    <p><a href="{{ route('events.show') }}">Event</a></p>
                    <p><a href="{{ route('livestream') }}">Livestream</a></p>
                </div>
                <div class="col-md-4 footer-links">
                    <p><b>Sosial Media Kami</b></p>
                    <div class="social-icons">
                        <a href="https://www.instagram.com/alfamidigemabudaya?igsh=MXdsa2EwZW12bDhkcA==" target="_blank">
                            <i class="bi bi-instagram text-white mx-2"></i>
                        </a>
                        <a href="https://www.tiktok.com/@midishare_alfamidi?_t=8qRXDkSedOR&_r=1" target="_blank">
                            <i class="bi bi-tiktok text-white mx-2"></i>
                        </a>
                        <a href="https://youtube.com/@alfamidigemabudaya8446?si=fMM_oXtcBdi6XZfX" target="_blank">
                            <i class="bi bi-youtube text-white mx-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>       
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        window.addEventListener('scroll', function() {
            var navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scroll');
            } else {
                navbar.classList.remove('navbar-scroll');
            }
        });
        document.getElementById('logoutForm').addEventListener('submit', function(e) {
            // Show loading overlay
            document.getElementById('loadingOverlay').style.display = 'flex';
        });
    </script>
</body>
</html>
