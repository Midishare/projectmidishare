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
                <th>INT</th>
                <th>INO</th>
                <th>KST</th>
                <th>OPP</th>
                <th>KPT</th>
                <th>PBB</th>
                <th>PDP</th>
                <th>MDM</th>
                <th>MKP</th>
                <th>KPP</th>
                <th>APM</th>
                <th>KEF</th>
                <th>PNG</th>
                <th>MHK</th>
                <th>KPD</th>
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
                            <input type="checkbox" name="OHK" {{ optional($user->gapknowledge)->OHK ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="BPA" {{ optional($user->gapknowledge)->BPA ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="MOM" {{ optional($user->gapknowledge)->MOM ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="INT" {{ optional($user->gapknowledge)->INT ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="INO" {{ optional($user->gapknowledge)->INO ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="KST" {{ optional($user->gapknowledge)->KST ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="OPP" {{ optional($user->gapknowledge)->OPP ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="KPT" {{ optional($user->gapknowledge)->KPT ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="PBB" {{ optional($user->gapknowledge)->PBB ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="PDP" {{ optional($user->gapknowledge)->PDP ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="MDM" {{ optional($user->gapknowledge)->MDM ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="MKP" {{ optional($user->gapknowledge)->MKP ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="KPP" {{ optional($user->gapknowledge)->KPP ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="APM" {{ optional($user->gapknowledge)->APM ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="KEF" {{ optional($user->gapknowledge)->KEF ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="PNG" {{ optional($user->gapknowledge)->PNG ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="MHK" {{ optional($user->gapknowledge)->MHK ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="KPD" {{ optional($user->gapknowledge)->KPD ? 'checked' : '' }}>
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
