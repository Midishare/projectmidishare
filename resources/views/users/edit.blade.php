@extends('layouts.layoutsadmin')

@section('content')

<div class="container">
        <h1 style="margin-top: 100px;">Edit User</h1>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label for="nik" class="col-md-4 col-form-label text-md-right">{{ __('NIK') }}</label>
                <div class="col-md-6">
                    <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik', $user->nik) }}" required>
                    @error('nik')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label for="lokasi" class="col-md-4 col-form-label text-md-right">{{ __('Lokasi') }}</label>
                <div class="col-md-6">
                    <input type="text" name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $user->lokasi) }}" required>
                    @error('lokasi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label for="branch" class="col-md-4 col-form-label text-md-right">{{ __('Branch') }}</label>
                <div class="col-md-6">
                    <input type="text" name="branch" id="branch" class="form-control @error('branch') is-invalid @enderror" value="{{ old('branch', $user->branch) }}" required>
                    @error('branch')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
    
            <div class="form-group row">
                <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Kelas') }}</label>
    
                <div class="col-md-6">
                    <select id="class" class="form-control @error('class') is-invalid @enderror" name="class" required>
                        <option value="">-- Select Kelas --</option>
                        <option value="MDP" {{ old('class', $user->class) == 'MDP' ? 'selected' : '' }}>MDP</option>
                        <option value="DP" {{ old('class', $user->class) == 'DP' ? 'selected' : '' }}>DP</option>
                        <option value="IP" {{ old('class', $user->class) == 'IP' ? 'selected' : '' }}>IP</option>
                        <!-- Add more classes as needed -->
                    </select>
    
                    @error('class')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
    
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                <div class="col-md-6">
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
                    <input type="checkbox" id="show-password"> Show Password
                    <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
    
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
    
@endsection
