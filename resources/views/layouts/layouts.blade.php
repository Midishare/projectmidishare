<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('icon/logomidi.png') }}" type="image/x-icon">
    <title>Midishare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
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

        .navbar {
            background-color: #ffffff; /* Warna latar belakang navbar putih */
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
        
        .dropdown-menu {
            left: 50%;
            transform: translateX(-18%);
        }

        /* Glassmorphism navbar */
        .navbar-glass {
            
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        /* Navbar saat di-scroll */
        .navbar-scroll {
            background-color: rgba(255, 255, 255, 0.2); /* Transparansi */
            backdrop-filter: blur(10px); /* Efek blur */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); /* Shadow lebih tajam */
        }
        .dropdown-menu .dropdown-item:hover,
        .dropdown-menu .dropdown-item:focus,
        .dropdown-menu .dropdown-item.active {
            background-color: #0056b3; /* Warna latar belakang dropdown saat hover dan aktif */
            color: #ffffff !important; /* Warna teks dropdown saat hover dan aktif */
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

        @media (max-width: 768px) {
            .navbar-nav .nav-item {
                margin-right: 0;
                margin-bottom: 0.5rem;
            }

            .navbar-nav {
                flex-direction: column;
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
            .navbar-glass {
            
            background-color: rgba(255, 255, 255, 0.7); /* Background lebih solid saat di-scroll */
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        .dropdown-menu{
                margin-left: 70px !important;
            }
        }

        
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg py-3 fixed-top navbar-glass">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"> <img src="{{ asset('icon/logomidi.png') }}" height="24" width="110" alt=""> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="col justify-content-center navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('berita.show') }}">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.show') }}">Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('livestream') }}">Livestream</a>
                    </li>
                    <li class="nav-item dropdown">
                        @auth
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Repository
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('repositoryall') }}">Knowledge Management</a></li>
                            <li><a class="dropdown-item" href="{{ route('belajarmandiri.show') }}">Belajar Mandiri</a></li>
                        </ul>
                        @endauth
                    </li> 
                </ul>
                <div class="nav-item">
                    @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link fs-2"><i class="bi bi-power me-2"></i></button>
                    </form>
                    @endauth
                </div>
                @guest
                <div class="btn btn-danger">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </div>
                @endguest
            </div>                
        </div>
    </nav>
    <div id="progress-container">
        <div id="progress-bar"></div>
    </div>
    <div class="container content">
        @yield('content') 
    </div>
    <footer class="custom-footer " style="margin-top: 200px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex justify-content-start align-items-center">
                        <img class="img-fluid mr-1" src="{{ asset('icon/logomidifooter.png') }}" alt="Logo" style="height: 4rem; width: 4rem;">
                    </div>  
                </div>
                <div class="col-md-6" >
                    <p style="text-align: right;">PT Midi Utama Indonesia, Tbk<br>
                        Alfa Tower Lt 10 - 12, Jl  Jalur Sutera Barat Kav 7-9 Alam<br>
                        Sutera, Panunggangan Timur, Pinang, Tangerang</p>
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
    </script>
</body>
</html>
