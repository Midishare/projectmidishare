@extends('layouts.layoutsadmin')

@section('content')
<section>
<div style="margin-top: 7rem;">
    <h2 class="text-center" style="font-family: 'Roboto', sans-serif; font-size: 2.5rem; font-weight: bold; color: #333;">Belajar <span style="color: #e92525;">Mandiri</span></h2>
    @if($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{$message}}</strong>
    </div>
    @endif
            <div class="col-md-12 bg-white p-4">
                <a href="{{ route('belajarmandiri.addmandiri') }}">
                    <button class="btn btn-primary mb-3"><strong>+</strong>Tambah</button>
                </a>
                <div class="row g-2 align-items-center justify-content-end">
                    <div class="col-auto">
                        <input type="text" id="searchInput" class="form-control" aria-describedby="searchHelpInline" placeholder="Search...">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" onclick="searchBerita()"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <form action="{{ route('belajarmandiri.deleteSelected') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger mb-3">Hapus Terpilih</button>
                <table class="table table-responsive table-bordered table-hover table-striped" style="margin-top: 2rem;">
                <thead>
                    <tr>
                        <th width="5%"><input type="checkbox" id="select-all"></th>
                        <th width="5%">No.</th>
                        <th width="22%">Judul</th>
                        <th>Link</th>
                        <th width="13%">Gambar</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mandiri as $i => $item)
                    <tr>
                        <td><input type="checkbox" name="selectedItems[]" value="{{ $item->id }}"></td>
                        <td>{{ $mandiri->firstItem() + $i }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>
                            <a href="{{ $item->link }}" target="_blank">{{ $item->link }}</a>
                        </td>                    
                        <td><img src="{{ asset('storage/icon/' . $item->gambarmandiri) }}" alt="Gambar Belajar Mandiri" style="max-width: 100px;"></td>
                        <td>
                            <a href="{{ route('belajarmandiri.editmandiri', $item->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil-square" style="color: azure"></i>
                            </a>
                            <a href="{{ route('belajarmandiri.deletemandiri', $item->id) }}" class="btn btn-danger" style="color: azure">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <button type="submit" class="btn btn-danger">Hapus Terpilih</button> --}}
            </form>
            {{ $mandiri->links() }}
        </div>
    </div>
</section>
<script>
    function searchBerita() {
        var keyword = document.getElementById('searchInput').value;
        window.location.href = "{{ route('belajarmandiri.show_by_adminmandirishow') }}?search=" + keyword;
    }

    // Toggle Select All Checkbox
    document.getElementById('select-all').addEventListener('change', function(e) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"][name="selectedItems[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = e.target.checked;
        });
    });
</script>
@endsection
