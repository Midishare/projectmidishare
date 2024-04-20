@extends('template.admin.main')

@section('content')
    <h1>User Details</h1>

    <div>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Nik:</strong> {{ $user->nik }}</p>
        <p><strong>Address:</strong></p>
        <p>{{ $address->lokasi }}</p>
        <p>{{ $address->branch }}</p>

        <div class="mt-3">
            <a href="{{ route('addresses.edit', $address->id) }}" class="btn btn-primary">Edit Address</a>

            <form action="{{ route('addresses.destroy', $address->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Address</button>
            </form>
        </div>
    </div>  
@endsection
