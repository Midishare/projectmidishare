<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            font-family: 'Poppins';
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
            margin: 0;
        }
        body::before{
            opacity: 0.5;
        }
        .footer-container {
            margin-top: auto;
        }

        footer {
            background-color: #E62323;
            color: white;
            padding: 1rem 0;
            text-align: center;
            margin-top: auto;
            width: 100%;
        }
        
        .container {
            background-color: #fff;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); /* Shadow */
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1000px; /* Adjusted max-width */
            width: 65%; /* Adjusted width */
            height: 80%; /* Adjusted height */
            padding: 60px;
            border-radius: 10px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-container {
            background-color: #fff
            margin-left: -50px;
            flex: 1;
            padding-right: 20px;
        }

        .form-container h1 {
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 1px;
        }

        button {
            padding: 5px 5px;
            height: 3.2rem;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 1px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        footer {
            margin-top: 20px;
            text-align: center;
        }

        /* Mengatur ukuran gambar */
        .book-image {
            margin-top: -40px;
            max-width: 300px;
            height: auto;
        }

        @media (max-width: 992px) {
        
        body{
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        body::before{
            opacity: 0.5;
        }
        .book-image{
            display: none;
        }
        .container{
            width: 300px;
            margin-bottom: 170px;
        }
        .form-container{
            display: flex;
            flex-direction: column;
            margin-left: -100px;
        }
        .form-container .responsive .wow form input{
            margin-left: 66px;
            width: 250px;
            justify-content: center;
        }
        .form-container .responsive .wow form .bttn{
            width: 150px;
            margin-left: 120px;
        }
        .form-container h1{
            margin-left: 60px;
        }
        }
    </style>
</head>
<body style="background-image: url('{{ asset('icon/bglogin.JPG') }}')">
    <div class="container">
        <div class="form-container">
            <h1>Login</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="d-flex justify-content-between responsive">
                <div class="w-100 wow">
                    <form action="{{ route('signin') }}" method="POST">
                        @csrf
                        <input type="text" id="nik" name="nik" required placeholder="Masukkan Username Anda">
                        <input type="password" id="password" name="password" required placeholder="Masukkan Password Anda">
                        <button class="bttn" type="submit">Login</button>
                    </form>
                </div>
                <div class="">
                    <img class="book-image" src="{{ asset('icon/book.png') }}" alt="Buku">
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container-footer">
            <img class="img-fluid mr-1" src="{{ asset('icon/logomidifooter.png') }}" alt="Logo" style="height: 4rem; width: 4rem;">
            <p>&copy; 2024 Midishare</p>
            <p style="text-align: right;">PT Midi Utama Indonesia, Tbk<br>Alfa Tower Lt 10 - 12, Jl  Jalur Sutera Barat Kav 7-9 Alam<br>Sutera, Panunggangan Timur, Pinang, Tangerang</p>
        </div>
    </footer>
</body>
</html>