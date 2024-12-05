@extends($layout)

@section('content')
    <div class="container" style="margin-top: 70px;">
        <div class="container-fluid p-4 d-flex align-items-center justify-content-between">
            <a href="javascript:history.back()" class="btn back-button">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
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
        <div class="card">
            <div class="card-header">
                <h2>Riwayat Pemeriksaan</h2>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kadar Gula</th>
                            <th>Kondisi</th>
                            <th>Status</th>
                            <th>Level</th>
                            <th>Risiko</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bloodSugars as $bloodSugar)
                            <tr>
                                <td>{{ $bloodSugar->checked_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $bloodSugar->blood_sugar_level }} mg/dL</td>
                                <td>{{ ucfirst($bloodSugar->condition) }}</td>
                                <td>{{ $bloodSugar->result_status }}</td>
                                <td>{{ $bloodSugar->result_level }}</td>
                                <td>{{ $bloodSugar->result_risk }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $bloodSugars->links() }}
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h2>Hasil Analisis</h2>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h4>Status: {{ $bloodSugar->result_status }}</h4>
                    <p>Level: {{ $bloodSugar->result_level }}</p>
                    <p>Risiko: {{ $bloodSugar->result_risk }}</p>
                </div>

                @if (session('result'))
                    <div class="mt-4">
                        <h5>Rekomendasi:</h5>
                        <ul>
                            @foreach (session('result')['advice'] as $advice)
                                <li>{{ $advice }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
