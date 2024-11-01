@extends('layouts.layoutsadmin')

@section('content')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
    }
    .search-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .search-bar form {
        display: flex;
        align-items: center;
    }
    .search-bar .input-group {
        width: 300px;
    }
</style>
<div class="container mt-4 mb-6">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="search-bar mb-2 mt-5">
                <h2 class="display-8">User List</h2>
                <form action="{{ route('users.index') }}" method="GET" class="form-inline">
                    <div class="input-group mt-3">
                        <input type="text" name="query" class="form-control" placeholder="Search users" value="{{ request('query') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="mb-3">
                <a href="#" class="btn btn-danger" id="deleteAllSelectedRecord">Delete All</a>
                <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i> Add User</a>
                <a href="{{ route('users.import.form') }}" class="btn btn-success"><i class="bi bi-cloud-upload"></i> Import Users</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('exists'))
                <div class="alert alert-danger">{{ session('exists') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center"><input type="checkbox" id="chkCheckAll"/></th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Lokasi</th>
                            <th class="text-center">Branch</th>
                            <th class="text-center">Jabatan</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr id="sid{{ $user->id }}">
                            <td class="text-center"><input type="checkbox" name="ids" class="checkBoxClass" value="{{ $user->id }}"/></td>
                            <td class="text-center">{{ $user->nik }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->lokasi }}</td>
                            <td>{{ $user->branch }}</td>
                            <td>{{ $user->jabatan }}</td>
                            <td class="text-center">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil" style="color: white;"></i></a>
                                @if (!$user->hasRole('admin'))
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#chkCheckAll").click(function() {
            $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        });

        $("#deleteAllSelectedRecord").click(function(e){
            e.preventDefault();
            var allids = [];

            $("input:checkbox[name=ids]:checked").each(function(){
                allids.push($(this).val());
            });

            if(allids.length > 0) {
                $.ajax({
                    url: "{{ route('user.deleteSelected') }}",
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}",
                        ids: allids
                    },
                    success: function(response) {
                        $.each(allids, function(key, val) {
                            $("#sid" + val).remove();
                        });
                        alert(response.success);
                    },
                    error: function(xhr) {
                        alert('Error occurred while deleting users.');
                    }
                });
            } else {
                alert('Please select at least one user to delete.');
            }
        });
    });
</script>

@endsection