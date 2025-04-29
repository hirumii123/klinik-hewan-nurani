@extends('layouts.admin')

@section('title', 'Kategori Gejala')

@section('content')
<h2 class="mb-4">Kategori Gejala</h2>

<a href="{{ route('kategori-gejala.create') }}" class="btn btn-primary mb-3">+ Tambah Gejala</a>

<table class="table table-bordered align-middle">
    <thead class="table-light">
        <tr>
            <th>Kategori Gejala</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kategori_gejalas as $item)
             <tr>
                <td>{{ $item->kategori }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
