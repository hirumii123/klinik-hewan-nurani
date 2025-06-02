@extends('layouts.admin')

@section('title', 'Edit Penyakit')

@section('content')
<h2 class="mb-4">✏️ Edit Penyakit</h2>

<form action="{{ route('rules.update', $rule->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Gejala (Symptom)</label>
        <select name="symptom_id" class="form-select" required>
            @foreach ($symptoms as $symptom)
                <option value="{{ $symptom->id }}" {{ $symptom->id == $rule->symptom_id ? 'selected' : '' }}>
                    {{ $symptom->code }} - {{ $symptom->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Penyakit (Disease)</label>
        <select name="disease_id" class="form-select" required>
            @foreach ($diseases as $disease)
                <option value="{{ $disease->id }}" {{ $disease->id == $rule->disease_id ? 'selected' : '' }}>
                    {{ $disease->code }} - {{ $disease->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">CF Value</label>
        <input type="number" name="cf_value" step="0.01" class="form-control @error('cf_value') is-invalid @enderror" value="{{ old('cf_value', $rule->cf_value ?? '') }}" required>
        @error('cf_value')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('rules.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
