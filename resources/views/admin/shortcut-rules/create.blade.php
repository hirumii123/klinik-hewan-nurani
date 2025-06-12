@extends('layouts.admin')

@section('title', 'Tambah Shortcut')

@section('content')
<h2 class="mb-4">➕ Tambah Shortcut Gejala ke Penyakit</h2>

<form action="{{ route('shortcut-rules.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Pilih Penyakit</label>
        <select name="disease_code" class="form-select" required>
            <option value="">Pilih Penyakit</option>
            @foreach ($diseases as $disease)
                <option value="{{ $disease->code }}">{{ $disease->code }} - {{ $disease->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Pilih Gejala Shortcut</label>
        <div class="form-control" style="height: auto;">
            @foreach ($symptoms as $symptom)
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="symptom_codes[]"
                        value="{{ $symptom->code }}"
                        id="gejala_{{ $symptom->id }}"
                        {{ in_array($symptom->code, old('symptom_codes', [])) ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="gejala_{{ $symptom->id }}">
                        {{ $symptom->code }} - {{ $symptom->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <button type="submit" class="btn btn-success">Simpan Shortcut</button>
    <a href="{{ route('shortcut-rules.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
