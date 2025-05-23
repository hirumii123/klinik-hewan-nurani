@extends('layouts.admin')

@section('title', 'Edit Penyakit')

@section('content')
<h2 class="mb-4">✏️ Edit Penyakit</h2>

<form action="{{ route('penyakit.update', $disease->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Kode Penyakit</label>
        <input type="text" name="code" class="form-control" value="{{ old('code', $disease->code) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama Penyakit</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $disease->name) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Pilih Gejala</label>
        <div class="form-control" style="height: auto;">
            @foreach ($symptoms as $symptom)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="symptoms[]" value="{{ $symptom->id }}"
                        id="gejala_{{ $symptom->id }}"
                        {{ in_array($symptom->id, old('symptoms', $selectedSymptoms)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="gejala_{{ $symptom->id }}">
                        {{ $symptom->code }} - {{ $symptom->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Solusi</label>
        <textarea name="solution" class="form-control" rows="4">{{ old('solution', $disease->solution) }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('penyakit.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
