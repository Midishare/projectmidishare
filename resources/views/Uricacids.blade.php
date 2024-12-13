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
                <h2>Cek Kadar Asam Urat</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('uricacid.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="uric_acid_level" class="form-label">Kadar Asam Urat (mg/dL)</label>
                        <input type="number" step="0.1"
                            class="form-control @error('uric_acid_level') is-invalid @enderror" id="uric_acid_level"
                            name="uric_acid_level" required>
                        @error('uric_acid_level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender"
                            required>
                            <option value="">Pilih jenis kelamin...</option>
                            <option value="male">Laki-laki</option>
                            <option value="female">Perempuan</option>
                        </select>
                        @error('gender')
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
                            <th>Kadar Asam Urat</th>
                            <th>Jenis Kelamin</th>
                            <th>Status</th>
                            <th>Level</th>
                            <th>Risiko</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($uricAcids as $uricAcid)
                            <tr>
                                <td>{{ $uricAcid->checked_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $uricAcid->uric_acid_level }} mg/dL</td>
                                <td>{{ $uricAcid->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $uricAcid->result_status }}</td>
                                <td>{{ $uricAcid->result_level }}</td>
                                <td>{{ $uricAcid->result_risk }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $uricAcids->links() }}
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h2>Hasil Analisis</h2>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    @if ($latestAnalysis->result_status === 'Belum Ada Data')
                        <div class="alert alert-warning">
                            <p>Tidak ada data analisis terbaru.</p>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <p>Status: {{ $latestAnalysis->result_status }}</p>
                            <p>Level: {{ $latestAnalysis->result_level }}</p>
                            <p>Risiko: {{ $latestAnalysis->result_risk }}</p>
                        </div>
                    @endif

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
@endsection
