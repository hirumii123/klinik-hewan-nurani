@extends('layouts.admin')

@section('title', 'Penyakit')

@section('content')
<h2 class="mb-4">Penyakit</h2>

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('penyakit.create') }}" class="btn btn-primary">+ Tambah Penyakit</a>

    <form action="{{ route('penyakit.index') }}" method="GET" class="d-flex gap-2">
        <div class="input-group">
            <select name="filter_disease" class="form-select">
                <option value="">Filter Berdasarkan Nama Penyakit</option>
                @foreach ($allDiseases as $disease)
                    <option value="{{ $disease->id }}" {{ request('filter_disease') == $disease->id ? 'selected' : '' }}>
                        {{ $disease->code }} - {{ $disease->name }}
                    </option>
                @endforeach
            </select>
            <button class="btn btn-outline-secondary" type="submit">Filter</button>
        </div>
        @if(request('filter_disease')) {{-- Hanya tampilkan tombol reset jika ada parameter filter_disease --}}
            <a href="{{ route('penyakit.index') }}" class="btn btn-danger">Reset</a>
        @endif
    </form>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
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
            @forelse ($diseases as $penyakit)
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
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data penyakit yang ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
