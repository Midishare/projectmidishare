@extends($layout)

@section('content')
    <div class="container">
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
    </div>
