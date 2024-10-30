@extends('template.user.main')

@section('content')
    <h1>User Details</h1>

    <div>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Nik:</strong> {{ $user->nik }}</p>
        <p><strong>Lokasi:</strong> {{ $user->lokasi }}</p>
        <p><strong>branch:</strong> {{ $user->branch }}</p>
        <p><strong>Jabatan:</strong> {{ $user->jabatan }}</p>
        
    </div> 
    <a href="{{ route('login') }}" class="btn btn-primary mt-3">Kembali ke Dashboard</a>
@endsection
