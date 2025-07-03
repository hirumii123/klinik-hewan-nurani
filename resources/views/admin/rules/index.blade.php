@extends('layouts.admin')

@section('title', 'Rules')

@section('content')
<h2 class="mb-4">CF Rules</h2>

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('rules.create') }}" class="btn btn-primary">+ Tambah CF Rules</a>

    <form action="{{ route('rules.index') }}" method="GET" class="d-flex gap-2 align-items-center flex-wrap">
        <div class="input-group" style="max-width: 250px;"> {{-- Added max-width for smaller filter input --}}
            <select name="filter_disease" class="form-select form-select-sm"> {{-- Added form-select-sm --}}
                <option value="">Filter Berdasarkan Penyakit</option>
                @foreach ($diseases as $disease)
                    <option value="{{ $disease->id }}" {{ request('filter_disease') == $disease->id ? 'selected' : '' }}>
                        {{ $disease->code }} - {{ $disease->name }}
                    </option>
                @endforeach
            </select>
        </div>
        {{-- Tambahkan filter berdasarkan gejala --}}
        <div class="input-group" style="max-width: 250px;"> {{-- Added max-width for smaller filter input --}}
            <select name="filter_symptom" class="form-select form-select-sm"> {{-- Added form-select-sm --}}
                <option value="">Filter Berdasarkan Gejala</option>
                @foreach ($symptoms as $symptom)
                    <option value="{{ $symptom->id }}" {{ request('filter_symptom') == $symptom->id ? 'selected' : '' }}>
                        {{ $symptom->code }} - {{ $symptom->name }}
                    </option>
                @endforeach
            </select>
            <button class="btn btn-outline-secondary btn-sm" type="submit">Filter</button> {{-- Added btn-sm --}}
        </div>
        @if(request('filter_disease') || request('filter_symptom'))
            <a href="{{ route('rules.index') }}" class="btn btn-danger btn-sm">Reset</a> {{-- Added btn-sm --}}
        @endif
    </form>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th style="width: 10%">Nama Penyakit</th>
                <th>Nama Gejala</th>
                <th>CF Value</th>
                <th style="width: 25%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rules as $rule)
                <tr>
                    <td>{{ $rule->disease->code }} - {{ $rule->disease->name }}</td>
                    <td>{{ $rule->symptom->code }} - {{ $rule->symptom->name }}</td>
                    <td>{{ $rule->cf_value }}</td>
                    <td>
                        <div class="d-flex gap-2 justify-content-start">
                            <a href="{{ route('rules.edit', $rule->id) }}" class="btn btn-sm"><img src="{{ asset('images/edit.png') }}" width="24"><span> Edit</span></a>
                            <form action="{{ route('rules.destroy', $rule->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm"><img src="{{ asset('images/delete.png') }}" width="24"><span> Delete</span></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data rule yang ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
