@extends('layouts.layoutsadmin')

@section('content')
    <div class="container" style="margin-top: 100px">
        <h1>Checklist Modul untuk User</h1>
        <form action="{{ route('admin.checklist.index') }}" method="GET" class="mb-3">
            <input type="text" name="search" placeholder="Cari pengguna..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Existing Grade Genap</th>
                        <th>IP</th>
                        <th>Existing Grade Ganjil</th>
                        <th>MDP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <form action="{{ route('admin.checklist.update', $user->id) }}" method="POST">
                                @csrf
                                <td>
                                    <input type="checkbox" name="existing_grade_genap"
                                        {{ optional($user->modChecklists)->existing_grade_genap ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" name="ip"
                                        {{ optional($user->modChecklists)->ip ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" name="existing_grade_ganjil"
                                        {{ optional($user->modChecklists)->existing_grade_ganjil ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" name="mdp"
                                        {{ optional($user->modChecklists)->mdp ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $users->appends(['search' => request('search')])->links() }}
        </div>
    </div>
    <style>
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin-bottom: 1rem;
        }

        .table {
            min-width: 750px;
            width: 100%;
        }

        .table thead th {
            position: sticky;
            top: 0;
            background: white;
            z-index: 1;
        }

        .table td,
        .table th {
            padding: 0.75rem;
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .table-responsive::after {
                content: '';
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                width: 5px;
                background: linear-gradient(to left, rgba(0, 0, 0, 0.05), transparent);
                pointer-events: none;
            }
        }
    </style>
@endsection
