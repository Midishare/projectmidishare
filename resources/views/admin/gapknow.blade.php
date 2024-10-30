@extends('layouts.layoutsadmin')

@section('content')
<div class="container" style="margin-top: 100px">
    <h1>Checklist Gap Knowledge untuk User</h1>

    <!-- Formulir Pencarian -->
    <form action="{{ route('admin.gapknow.index') }}" method="GET" class="mb-3">
        <input type="text" name="search" placeholder="Cari pengguna..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>OHK</th>
                <th>BPA</th>
                <th>MOM</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <form action="{{ route('admin.gapknow.update', $user->id) }}" method="POST">
                        @csrf
                        <td>
                            <input type="checkbox" name="OHK" {{ $user->gapknowledge->OHK ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="BPA" {{ $user->gapknowledge->BPA ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="MOM" {{ $user->gapknowledge->MOM ? 'checked' : '' }}>
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
