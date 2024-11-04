@extends('layouts.layouts')

@section('content')
<div class="container text-center livestream-container">
    <div class="form-container text-bg-light">
        <div class="row">
            <div class="col">
                <h1 class="text-start">Halo! {{ $user->name }}</h1>
                <div class="row">
                    <div class="col text-start"><p>{{ $user->jabatan }} - <span class="text-body-secondary">{{ $user->lokasi }},{{ $user->branch }}</span></p></div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <div class="row">
                        <div>
                            <div class="card bg-box" style="width: 18rem;">
                                <div class="card-header">
                                  MOD
                                </div>
                                <ul class="list-group list-group-flush text-start">
                                  <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">Existing Grade Genap</div>
                                        <div class="col">{{ optional($user->modChecklists)->existing_grade_genap ? 'Selesai' : 'Belum Selesai' }}</div>
                                    </div>
                                  </li>
                                  <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">IP</div>
                                        <div class="col">{{ optional($user->modChecklists)->ip ? 'Selesai' : 'Belum Selesai' }}</div>
                                    </div>
                                  </li>
                                  <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">Existing Grade Ganjil</div>
                                        <div class="col">{{ optional($user->modChecklists)->existing_grade_ganjil ? 'Selesai' : 'Belum Selesai' }}</div>
                                    </div>
                                  </li>
                                  <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">MDP</div>
                                        <div class="col">{{ optional($user->modChecklists)->mdp ? 'Selesai' : 'Belum Selesai' }}</div>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="row">
                        <div>
                            <div class="card bg-box" style="width: 18rem;">
                                <div class="card-header">
                                    GAP Knowledge
                                </div>
                                <ul class="list-group list-group-flush text-start">
                                  <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">OHK</div>
                                        <div class="col">{{ optional($user->gapknowledge)->OHK ? 'Selesai' : 'Belum Selesai' }}</div>
                                    </div>
                                  </li>
                                  <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">BPA</div>
                                        <div class="col">{{ optional($user->gapknowledge)->BPA ? 'Selesai' : 'Belum Selesai' }}</div>
                                    </div>
                                  </li>
                                  <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">MOM</div>
                                        <div class="col">{{ optional($user->gapknowledge)->MOM ? 'Selesai' : 'Belum Selesai' }}</div>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card bg-box mb-3" style="max-width: 18rem;">
                        <div class="card-header">Rekomendasi belajar</div>
                        <ul class="list-group list-group-flush text-start">
                            <li class="list-group-item">
                              <div class="row">
                                <p class="card-text">@if ($rekomendasi && $rekomendasi->count() > 0)
                                    @foreach ($rekomendasi as $item)
                                        <div>{!! $item->rekomendasi !!}</div>
                                    @endforeach
                            @else
                                <p>Belum ada rekomendasi belajar untuk Anda.</p>
                            @endif</p>
                              </div>
                            </li>
                          </ul>
                      </div>
                </div>
            </div>
            <div>
                <h1 class="text-start">History</h1>
                <div class="card text-center ">
                    <div class="card-body">
                        <p class="card-text">@if ($history && $history->count() > 0)
                            @foreach ($history as $item)
                                <div>{!! $item->history !!}</div>
                            @endforeach
                    @else
                        <p>Belum ada history belajar untuk Anda.</p>
                    @endif</p>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>

<style>
    .livestream-container { 
        margin-top: 10vh; 
        width: 100%; 
        max-width: 1200px; 
        padding: 0 15px; 
    }
    .form-container { 
        color: white;  
        padding: 2rem; 
        border-radius: 10px; 
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
        width: 100%; }
    .text-desktop { 
        margin-top: 100px; 
    }
    .bg-box {
        color: #fff;
        background-color: #E62323;
    }
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
