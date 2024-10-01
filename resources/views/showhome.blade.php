@extends('layouts.layoutsadmin')

@section('content')
<div style="margin-top: 7rem;">
    <h2 class="text-center">List Gambar Home</h2>
    @if($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{$message}}</strong>
    </div>
    @endif
    <div class="col-md-12 bg-white p-4">
        <a href="{{ route('dashboard.addhome') }}">
            <button class="btn btn-primary mb-3"><strong>+</strong>Tambah</button>
        </a>
        <form id="deleteSelectedForm" method="POST" action="{{ route('dashboard.deleteSelectedHome') }}">
            @csrf
            <button type="submit" class="btn btn-danger mb-3" onclick="return confirm('Are you sure you want to delete selected items?')">
                <strong>Delete All</strong>
            </button>
            <table class="table table-responsive table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th width="3%"><input type="checkbox" id="select-all"></th>
                        <th width="5%">No</th>
                        <th>Gambar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($home as $index => $item)
                    <tr>
                        <td><input type="checkbox" name="ids[]" value="{{ $item->id }}"></td>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if ($item->image)
                            <img src="{{ asset('storage/gambar/' . $item->image) }}" alt="Gambar Repository" style="max-width: 100px; max-height: 100px;">
                            @else
                            <span>Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('dashboard.edithome', ['id' => $item->id]) }}" class="btn btn-warning">
                                <i class="bi bi-pencil-square" style="color: azure"></i>
                            </a>
                            <a href="{{ route('dashboard.deletehome', ['id' => $item->id]) }}" class="btn btn-danger" style="color: azure" onclick="return confirm('Are you sure you want to delete this item?')">
                                <i class="bi bi-trash"></i>
                            </a>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        <div class="d-flex justify-content-center">
            {{ $home->links() }}
        </div>        
    </div>
</div>
<script>
    document.getElementById('select-all').onclick = function() {
        var checkboxes = document.getElementsByName('ids[]');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    }
</script>
@endsection