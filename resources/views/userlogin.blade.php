<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <title>Login</title>
</head>
<body>
    <div class="welcome-container">
        <h2>Welcome!</h2>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $item)
            <li> {{ $item }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ url('/userlogin') }}" method="POST">
        @csrf
        <div class="container">
            <input type="text" id="nik" name="nik" placeholder="NIK" value="{{ old('nik') }}">
            <input type="password" id="password" name="password" placeholder="Password">
            <button type="submit">Login</button>
        </div>
    </form>
    <footer>
        <div class="container-footer">
            <img class="img-fluid mr-1" src="{{ asset('storage/logomidifooter.png') }}" alt="Logo">
            <p>&copy; 2024 Midishare</p>
            <p style="text-align: right;">PT Midi Utama Indonesia, Tbk<br>Alfa Tower Lt 10 - 12, Jl  Jalur Sutera Barat Kav 7-9 Alam<br>Sutera, Panunggangan Timur, Pinang, Tangerang</p>
        </div>
    </footer>
</body>
</html>
