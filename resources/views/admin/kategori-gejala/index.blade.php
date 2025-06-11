@extends('layouts.admin')

@section('title', 'Kategori Gejala')

@section('content')
<h2 class="mb-4">Kategori Gejala</h2>

<a href="{{ route('kategori-gejala.create') }}" class="btn btn-primary mb-3">+ Tambah Kategori</a>

<table class="table table-bordered align-middle">
    <thead class="table-light">
        <tr>
            <th>Kategori Gejala</th>
            <th>Aksi</th>
        </tr>
    </thead>
<tbody>
    @foreach ($kategori_gejalas as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>
                <a href="{{ route('kategori-gejala.edit', $item->id) }}" class="btn btn-sm"><img src="{{ asset('images/edit.png') }}" width="24"><span> Edit</span></a>
                <form action="{{ route('kategori-gejala.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm"><img src="{{ asset('images/delete.png') }}" width="24"><span> Delete</span></button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

</table>
@endsection
