@extends('layouts.layouts')

@section('content')
<div class="container text-center livestream-container">
    <h1>Profile</h1>
    <div class="form-container">
        <h1 class="form-header text-center">Profile {{ $user->name }}</h1>
        <div class="row">
            <div class="table-transparant">
                <table class="table text-start align-self-center">
                    <tbody>
                      <tr>
                        <th scope="">ID</th>
                        <td>{{ $user->id }}</td>
                      </tr>
                      <tr>
                        <th scope="">Nama</th>
                        <td>{{ $user->name }}</td>
                      </tr>
                      <tr>
                        <th scope="">Jabatan</th>
                        <td>{{ $user->jabatan }}</td>
                      </tr>
                      <tr>
                        <th scope="">Lokasi Kerja</th>
                        <td>{{ $user->lokasi }}</td>
                      </tr>
                    </tbody>
                </table>

                <div class="form-container">
                    <h2 class="text-center">Status Checklist MOD</h2>
                    <table class="table text-start align-self-center">
                        <thead>
                            <tr>
                                <th>Modul</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Existing Grade Genap</td>
                                <td>{{ optional($user->modChecklists)->existing_grade_genap ? 'Selesai' : 'Belum Selesai' }}</td>
                            </tr>
                            <tr>
                                <td>IP</td>
                                <td>{{ optional($user->modChecklists)->ip ? 'Selesai' : 'Belum Selesai' }}</td>
                            </tr>
                            <tr>
                                <td>Existing Grade Ganjil</td>
                                <td>{{ optional($user->modChecklists)->existing_grade_ganjil ? 'Selesai' : 'Belum Selesai' }}</td>
                            </tr>
                            <tr>
                                <td>MDP</td>
                                <td>{{ optional($user->modChecklists)->mdp ? 'Selesai' : 'Belum Selesai' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-container">
                    <h2 class="text-center">Status Checklist GAP Knowledge</h2>
                    <table class="table text-start align-self-center">
                        <thead>
                            <tr>
                                <th>Modul</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>OHK</td>
                                <td>{{ optional($user->gapknowledge)->OHK ? 'Selesai' : 'Belum Selesai' }}</td>
                            </tr>
                            <tr>
                                <td>BPA</td>
                                <td>{{ optional($user->gapknowledge)->BPA ? 'Selesai' : 'Belum Selesai' }}</td>
                            </tr>
                            <tr>
                                <td>MOM</td>
                                <td>{{ optional($user->gapknowledge)->MOM ? 'Selesai' : 'Belum Selesai' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Rekomendasi Belajar -->
                <div class="form-container">
                    <h2 class="text-center">Rekomendasi Belajar</h2>
                    @if ($rekomendasi && $rekomendasi->count() > 0)
                            @foreach ($rekomendasi as $item)
                                <div>{!! $item->rekomendasi !!}</div> <!-- Pastikan field ini sesuai dengan yang ada di tabel -->
                            @endforeach
                    @else
                        <p>Belum ada rekomendasi belajar untuk Anda.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .livestream-container { margin-top: 10vh; width: 100%; max-width: 1200px; padding: 0 15px; }
    .form-container { color: white; background-color: #0253BB; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 100%; }
    .text-desktop { margin-top: 100px; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const audio = document.getElementById('waitingAudio');
        const icon = document.getElementById('rotatingIcon');

        audio.addEventListener('play', function() { icon.classList.add('rotating'); });
        audio.addEventListener('pause', function() { icon.classList.remove('rotating'); });
        audio.addEventListener('ended', function() { icon.classList.remove('rotating'); });
    });
</script>
@endsection
