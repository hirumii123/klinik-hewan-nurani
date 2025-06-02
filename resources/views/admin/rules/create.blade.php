@extends('layouts.admin')

@section('title', 'Tambah Rules')

@section('content')
<h2 class="mb-4">➕ Tambah Rules Baru</h2>

<form action="{{ route('rules.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Pilih Penyakit</label>
        <select name="disease_id" class="form-control" required>
            <option value="">-- Pilih Penyakit --</option>
            @foreach ($diseases as $disease)
                <option value="{{ $disease->id }}" {{ old('disease_id') == $disease->id ? 'selected' : '' }}>
                    {{ $disease->code }} - {{ $disease->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Pilih Gejala</label>
        <select name="symptom_id" class="form-control" required>
            <option value="">-- Pilih Gejala --</option>
            @foreach ($symptoms as $symptom)
                <option value="{{ $symptom->id }}" {{ old('symptom_id') == $symptom->id ? 'selected' : '' }}>
                    {{ $symptom->code }} - {{ $symptom->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">CF Value</label>
        <input type="number" step="0.01" min="0" max="1" name="cf_value" class="form-control" value="{{ old('cf_value') }}" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('rules.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
