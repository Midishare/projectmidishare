@extends('layouts.layoutsadmin')

@section('content')
<div class="container" style="margin-top: 100px">
    <h1>Checklist Gap Knowledge untuk User</h1>

    <!-- Formulir Pencarian -->
    <form action="{{ route('admin.unslearn.index') }}" method="GET" class="mb-3">
        <input type="text" name="search" placeholder="Cari pengguna..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>KS</th>
                <th>BS</th>
                <th>Webinar</th>
                <th>Sme</th>
                <th>Leader's talk</th>
                <th>Online Course</th>
                <th>Cop</th>
                <th>Podcast</th>
                <th>Jurnal</th>
                <th>Forum Diskusi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <form action="{{ route('admin.unslearn.update', $user->id) }}" method="POST">
                        @csrf
                        <td>
                            <input type="number" name="ks" value="{{ optional($user->unstructedlearningchecklist)->ks ?? 0 }}" min="0" max="9999">
                        </td>
                        <td>
                            <input type="number" name="bs" value="{{ optional($user->unstructedlearningchecklist)->bs ?? 0 }}" min="0" max="9999">
                        </td>
                        <td>
                            <input type="number" name="webinar" value="{{ optional($user->unstructedlearningchecklist)->webinar ?? 0 }}" min="0" max="9999">
                        </td>
                        <td>
                            <input type="number" name="sme" value="{{ optional($user->unstructedlearningchecklist)->sme ?? 0 }}" min="0" max="9999">
                        </td>
                        <td>
                            <input type="number" name="leaderstalk" value="{{ optional($user->unstructedlearningchecklist)->leaderstalk ?? 0 }}" min="0" max="9999">
                        </td>
                        <td>
                            <input type="number" name="onlinecourse" value="{{ optional($user->unstructedlearningchecklist)->onlinecourse ?? 0 }}" min="0" max="9999">
                        </td>
                        <td>
                            <input type="number" name="cop" value="{{ optional($user->unstructedlearningchecklist)->cop ?? 0 }}" min="0" max="9999">
                        </td>
                        <td>
                            <input type="number" name="podcast" value="{{ optional($user->unstructedlearningchecklist)->podcast ?? 0 }}" min="0" max="9999">
                        </td>
                        <td>
                            <input type="number" name="jurnal" value="{{ optional($user->unstructedlearningchecklist)->jurnal ?? 0 }}" min="0" max="9999">
                        </td>
                        <td>
                            <input type="number" name="forumdiskusi" value="{{ optional($user->unstructedlearningchecklist)->forumdiskusi ?? 0 }}" min="0" max="9999">
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
