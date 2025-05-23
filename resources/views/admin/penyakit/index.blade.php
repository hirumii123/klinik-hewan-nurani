@extends('layouts.admin')

@section('title', 'Penyakit')

@section('content')
<h2 class="mb-4">🧾 Daftar Penyakit</h2>

<a href="{{ route('penyakit.create') }}" class="btn btn-primary mb-3">+ Tambah Penyakit</a>

<table class="table table-bordered align-middle">
    <thead class="table-light">
        <tr>
            <th style="width: 10%">Kode</th>
            <th>Nama Penyakit</th>
            <th>Gejala</th>
            <th>Solusi</th>
            <th style="width: 25%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($diseases as $penyakit)
            <tr>
                <td>{{ $penyakit->code }}</td>
                <td>{{ $penyakit->name }}</td>
                <td>
                    <ul class="mb-0 ps-3">
                        @foreach ($penyakit->rules as $rule)
                            @if ($rule->symptom)
                                <li>{{ $rule->symptom->code }} - {{ $rule->symptom->name }}</li>
                            @endif
                        @endforeach
                    </ul>
                </td>
                <td style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $penyakit->solution }}</td>
                <td>
                    <div class="d-flex gap-2 justify-content-start">
                        <a href="{{ route('penyakit.edit', $penyakit->id) }}" class="btn btn-sm"><img src="{{ asset('images/edit.png') }}" width="24"><span> Edit</span></a>
                        <form action="{{ route('penyakit.destroy', $penyakit->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm"><img src="{{ asset('images/delete.png') }}" width="24"><span> Delete</span></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
