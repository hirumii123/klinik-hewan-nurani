@extends('layouts.admin')

@section('title', 'Penyakit')

@section('content')
<h2 class="mb-4">Penyakit</h2>

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('penyakit.create') }}" class="btn btn-primary">+ Tambah Penyakit</a>

    {{-- Adjust form layout for smaller filters --}}
    <form action="{{ route('penyakit.index') }}" method="GET" class="d-flex gap-2 align-items-center flex-wrap">
        <div class="input-group" style="max-width: 250px;"> {{-- Limit overall input group width --}}
            <select name="filter_disease" class="form-select form-select-sm"> {{-- Use form-select-sm for smaller height --}}
                <option value="">Filter Berdasarkan Nama Penyakit</option>
                @foreach ($allDiseases as $disease)
                    <option value="{{ $disease->id }}" {{ request('filter_disease') == $disease->id ? 'selected' : '' }}>
                        {{ $disease->code }} - {{ $disease->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="input-group" style="max-width: 250px;"> {{-- Limit overall input group width --}}
            <select name="filter_symptom" class="form-select form-select-sm"> {{-- Use form-select-sm for smaller height --}}
                <option value="">Filter Berdasarkan Gejala</option>
                @foreach ($allSymptoms as $symptom)
                    <option value="{{ $symptom->id }}" {{ request('filter_symptom') == $symptom->id ? 'selected' : '' }}>
                        {{ $symptom->code }} - {{ $symptom->name }}
                    </option>
                @endforeach
            </select>
            <button class="btn btn-outline-secondary btn-sm" type="submit">Filter</button> {{-- Use btn-sm for smaller button --}}
        </div>
        @if(request('filter_disease') || request('filter_symptom'))
            <a href="{{ route('penyakit.index') }}" class="btn btn-danger btn-sm">Reset</a> {{-- Use btn-sm for smaller button --}}
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
