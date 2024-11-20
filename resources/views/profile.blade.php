@extends('layouts.layouts')

@section('content')
    <div class="container text-center profile-container">
        <div class="form-container text-bg-light">
            <div class="row">
                <div class="col">
                    <h1 class="text-start">Halo! {{ $user->name }}</h1>
                    <div class="row">
                        <div class="col text-start">
                            <p>{{ $user->jabatan }} - <span
                                    class="text-body-secondary">{{ $user->lokasi }},{{ $user->branch }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <div class="card bg-box mb-3 recommendation-box">
                            <div class="card-header">Rekomendasi belajar</div>
                            <ul class="list-group list-group-flush text-start">
                                <li class="list-group-item">
                                    <div class="row">
                                        <p class="card-text">
                                            @if ($rekomendasi && $rekomendasi->count() > 0)
                                                @foreach ($rekomendasi as $item)
                                                    <div>{!! $item->rekomendasi !!}</div>
                                                @endforeach
                                            @else
                                                <p>Belum ada rekomendasi belajar untuk Anda.</p>
                                            @endif
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <h1 class="text-start">MOD</h1>
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered border-danger">
                                    <thead>
                                        <tr>
                                            <th scope="col">Existing Grade Genap</th>
                                            <th scope="col">IP</th>
                                            <th scope="col">Existing Grade Ganjil</th>
                                            <th scope="col">MDP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ optional($user->modChecklists)->existing_grade_genap ? 'Done' : '-' }}
                                            </td>
                                            <td>{{ optional($user->modChecklists)->ip ? 'Done' : '-' }}</td>
                                            <td>{{ optional($user->modChecklists)->existing_grade_ganjil ? 'Done' : '-' }}
                                            </td>
                                            <td>{{ optional($user->modChecklists)->mdp ? 'Done' : '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <h1 class="text-start">GAP Knowledge</h1>
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered border-danger">
                                    <thead>
                                        <tr>
                                            <th scope="col">OHK</th>
                                            <th scope="col">BPA</th>
                                            <th scope="col">MOM</th>
                                            <th scope="col">INT</th>
                                            <th scope="col">INO</th>
                                            <th scope="col">KST</th>
                                            <th scope="col">OPP</th>
                                            <th scope="col">KPT</th>
                                            <th scope="col">PBB</th>
                                            <th scope="col">PDP</th>
                                            <th scope="col">MDM</th>
                                            <th scope="col">MKP</th>
                                            <th scope="col">KPP</th>
                                            <th scope="col">APM</th>
                                            <th scope="col">KEF</th>
                                            <th scope="col">PNG</th>
                                            <th scope="col">MHK</th>
                                            <th scope="col">KPD</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ optional($user->gapknowledge)->OHK ? 'Done' : '-' }}</td>
                                            <td>{{ optional($user->gapknowledge)->BPA ? 'Done' : '-' }}</td>
                                            <td>{{ optional($user->gapknowledge)->MOM ? 'Done' : '-' }}</td>
                                            <td>{{ optional($user->gapknowledge)->INT ? 'Done' : '-' }}</td>
                                            <td>{{ optional($user->gapknowledge)->INO ? 'Done' : '-' }}</td>
                                            <td>{{ optional($user->gapknowledge)->KST ? 'Done' : '-' }}</td>
                                            <td>{{ optional($user->gapknowledge)->OPP ? 'Done' : '-' }}</td>
                                            <td>{{ optional($user->gapknowledge)->KPT ? 'Done' : '-' }}</td>
                                            <td>{{ optional($user->gapknowledge)->PBB ? 'Done' : '-' }}</td>
                                            <td>{{ optional($user->gapknowledge)->PDP ? 'Done' : '-' }}</td>
                                            <td>{{ optional($user->gapknowledge)->MDM ? 'Done' : '-' }}</td>
                                            <td>{{ optional($user->gapknowledge)->MKP ? 'Done' : '-' }}</td>
                                            <td>{{ optional($user->gapknowledge)->KPP ? 'Done' : '-' }}</td>
                                            <td>{{ optional($user->gapknowledge)->APM ? 'Done' : '-' }}</td>
                                            <td>{{ optional($user->gapknowledge)->KEF ? 'Done' : '-' }}</td>
                                            <td>{{ optional($user->gapknowledge)->PNG ? 'Done' : '-' }}</td>
                                            <td>{{ optional($user->gapknowledge)->MHK ? 'Done' : '-' }}</td>
                                            <td>{{ optional($user->gapknowledge)->KPD ? 'Done' : '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h1 class="text-start">Unstructed learning</h1>
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered border-danger">
                                    <thead>
                                        <tr>
                                            <th scope="col">KS</th>
                                            <th scope="col">BS</th>
                                            <th scope="col">Webinar</th>
                                            <th scope="col">SME</th>
                                            <th scope="col">Leader's Talk</th>
                                            <th scope="col">Online Course</th>
                                            <th scope="col">COP</th>
                                            <th scope="col">Podcast</th>
                                            <th scope="col">Jurnal</th>
                                            <th scope="col">Forum Diskusi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $user->unstructedlearningchecklist->ks ?? 0 }}</td>
                                            <td>{{ $user->unstructedlearningchecklist->ks ?? 0 }}</td>
                                            <td>{{ $user->unstructedlearningchecklist->webinar ?? 0 }}</td>
                                            <td>{{ $user->unstructedlearningchecklist->sme ?? 0 }}</td>
                                            <td>{{ $user->unstructedlearningchecklist->leaderstalk ?? 0 }}</td>
                                            <td>{{ $user->unstructedlearningchecklist->onlinecourse ?? 0 }}</td>
                                            <td>{{ $user->unstructedlearningchecklist->cop ?? 0 }}</td>
                                            <td>{{ $user->unstructedlearningchecklist->podcast ?? 0 }}</td>
                                            <td>{{ $user->unstructedlearningchecklist->jurnal ?? 0 }}</td>
                                            <td>{{ $user->unstructedlearningchecklist->forumdiskusi ?? 0 }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .profile-container {
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
            width: 100%;
        }

        .text-desktop {
            display: none;
        }

        .recommendation-box {
            font-size: 1.3rem;
            width: 80%;
            max-width: 100%;
            margin: 0 auto;
            color: #fff;
            background-color: #E62323;
        }

        @media (max-width: 768px) {
            .recommendation-box {
                width: 100%;
            }

            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .text-desktop {
                display: none;
            }
        }
    </style>
@endsection
