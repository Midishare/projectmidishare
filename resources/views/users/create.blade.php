@extends('layouts.layoutsadmin')

@section('content')
    <div class="container-fluid" style="margin-top: 70px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create User</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nik"
                                    class="col-md-4 col-form-label text-md-right">{{ __('ID') }}</label>

                                <div class="col-md-6">
                                    <input id="nik" type="text"
                                        class="form-control @error('nik') is-invalid @enderror" name="nik"
                                        value="{{ old('nik') }}" required>

                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lokasi"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Lokasi') }}</label>

                                <div class="col-md-6">
                                    <input id="lokasi" type="text"
                                        class="form-control @error('lokasi') is-invalid @enderror" name="lokasi"
                                        value="{{ old('lokasi') }}" required autocomplete="lokasi" autofocus>

                                    @error('lokasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="branch"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Branch') }}</label>

                                <div class="col-md-6">
                                    <input id="branch" type="text"
                                        class="form-control @error('branch') is-invalid @enderror" name="branch"
                                        value="{{ old('branch') }}" required autocomplete="branch" autofocus>

                                    @error('branch')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jabatan"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Jabatan') }}</label>

                                <div class="col-md-6">
                                    <input id="jabatan" type="text"
                                        class="form-control @error('jabatan') is-invalid @enderror" name="jabatan"
                                        value="{{ old('jabatan') }}" required autocomplete="jabatan" autofocus>

                                    @error('jabatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="class"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Kelas') }}</label>

                                <div class="col-md-6">
                                    <select id="class" class="form-control @error('class') is-invalid @enderror"
                                        name="class" required>
                                        <option value="None" {{ old('class') == 'None' ? 'selected' : '' }}>None</option>
                                        <option value="DP" {{ old('class') == 'DP' ? 'selected' : '' }}>DP</option>
                                        <option value="IP" {{ old('class') == 'IP' ? 'selected' : '' }}>IP</option>
                                    </select>

                                    @error('class')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                                <div class="col-md-6">
                                    <select id="role" class="form-control @error('role') is-invalid @enderror"
                                        name="role" required>
                                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="auditor" {{ old('role') == 'auditor' ? 'selected' : '' }}>Auditor
                                        </option>
                                    </select>

                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4 mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
