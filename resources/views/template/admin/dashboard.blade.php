@extends('layouts.layoutsadmin')
@section('content')
        @if (session('alamatKosong'))
            <div class="alert alert-danger">{{ session('alamatKosong') }}</div>
        @endif
        <div class="container mt-4">
            <h1>Welcome to Admin Dashboard</h1>
        <h2>Halo, {{ Auth::user()->name }}</h2>
        <h3>Peran Anda: Admin</h3>
        <a href="{{ route('users.profile') }}" class="btn btn-primary mt-3">Lihat Profile</a>
        </div> 
@endsection
