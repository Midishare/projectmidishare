@extends($layout)

@section('content')
    <div class="container">
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

                <div class="mt-4">
                    <a href="{{ route('blood-sugar.create') }}" class="btn btn-primary">Cek Lagi</a>
                    <a href="{{ route('blood-sugar.history') }}" class="btn btn-secondary">Lihat Riwayat</a>
                </div>
            </div>
        </div>
    </div>
