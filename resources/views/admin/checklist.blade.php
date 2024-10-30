@extends('layouts.layoutsadmin')

@section('content')
<div class="container" style="margin-top: 100px">
    <h1>Checklist Modul untuk User</h1>

    <!-- Formulir Pencarian -->
    <form action="{{ route('admin.checklist.index') }}" method="GET" class="mb-3">
        <input type="text" name="search" placeholder="Cari pengguna..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

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
            @foreach($users as $user)
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

    <!-- Kontrol Paginasi -->
    <div class="d-flex justify-content-center">
        {{ $users->appends(['search' => request('search')])->links() }}
    </div>
</div>
@endsection
