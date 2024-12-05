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
                <h2>Cek Kadar Kolesterol</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('cholesterol.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="total_cholesterol" class="form-label">Kolesterol Total (mg/dL)</label>
                        <input type="number" step="0.01"
                            class="form-control @error('total_cholesterol') is-invalid @enderror" id="total_cholesterol"
                            name="total_cholesterol" required>
                        @error('total_cholesterol')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="ldl_cholesterol" class="form-label">LDL Kolesterol (mg/dL)</label>
                        <input type="number" step="0.01"
                            class="form-control @error('ldl_cholesterol') is-invalid @enderror" id="ldl_cholesterol"
                            name="ldl_cholesterol">
                        @error('ldl_cholesterol')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="hdl_cholesterol" class="form-label">HDL Kolesterol (mg/dL)</label>
                        <input type="number" step="0.01"
                            class="form-control @error('hdl_cholesterol') is-invalid @enderror" id="hdl_cholesterol"
                            name="hdl_cholesterol">
                        @error('hdl_cholesterol')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="triglycerides" class="form-label">Trigliserida (mg/dL)</label>
                        <input type="number" step="0.01"
                            class="form-control @error('triglycerides') is-invalid @enderror" id="triglycerides"
                            name="triglycerides">
                        @error('triglycerides')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Analisis</button>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h2>Riwayat Pemeriksaan</h2>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Total Kolesterol</th>
                            <th>LDL</th>
                            <th>HDL</th>
                            <th>Trigliserida</th>
                            <th>Status</th>
                            <th>Level</th>
                            <th>Risiko</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cholesterolRecords as $record)
                            <tr>
                                <td>{{ $record->checked_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $record->total_cholesterol }} mg/dL</td>
                                <td>{{ $record->ldl_cholesterol }} mg/dL</td>
                                <td>{{ $record->hdl_cholesterol }} mg/dL</td>
                                <td>{{ $record->triglycerides }} mg/dL</td>
                                <td>{{ $record->result_status }}</td>
                                <td>{{ $record->result_level }}</td>
                                <td>{{ $record->result_risk }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $cholesterolRecords->links() }}
            </div>
        </div>

        @if (session('result'))
            <div class="card mt-3">
                <div class="card-header">
                    <h2>Hasil Analisis</h2>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h4>Status: {{ session('result')['status'] }}</h4>
                        <p>Level: {{ session('result')['level'] }}</p>
                        <p>Risiko: {{ session('result')['risk'] }}</p>
                    </div>

                    <div class="mt-4">
                        <h5>Rekomendasi:</h5>
                        <ul>
                            @foreach (session('result')['advice'] as $advice)
                                <li>{{ $advice }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
