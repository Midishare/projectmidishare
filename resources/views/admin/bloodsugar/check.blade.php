@extends('layouts.layoutsadmin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Cek Kadar Gula Darah</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('blood-sugar.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="blood_sugar_level" class="form-label">Kadar Gula Darah (mg/dL)</label>
                        <input type="number" class="form-control @error('blood_sugar_level') is-invalid @enderror"
                            id="blood_sugar_level" name="blood_sugar_level" required>
                        @error('blood_sugar_level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="condition" class="form-label">Kondisi</label>
                        <select class="form-select @error('condition') is-invalid @enderror" id="condition" name="condition"
                            required>
                            <option value="">Pilih kondisi...</option>
                            <option value="puasa">Puasa</option>
                            <option value="setelah_makan">Setelah Makan</option>
                        </select>
                        @error('condition')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Analisis</button>
                </form>
            </div>
        </div>
    </div>
