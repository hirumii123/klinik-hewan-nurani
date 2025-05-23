@extends('layouts.admin')

@section('title', 'Tambah Penyakit')

@section('content')
<h2 class="mb-4">➕ Tambah Penyakit Baru</h2>

<form action="{{ route('penyakit.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Kode Penyakit</label>
        <input type="text" name="code" class="form-control" value="{{ old('code') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama Penyakit</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Pilih Gejala</label>
        <div class="form-control" style="height: auto;">
            @foreach ($symptoms as $symptom)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="symptoms[]" value="{{ $symptom->id }}"
                        id="gejala_{{ $symptom->id }}">
                    <label class="form-check-label" for="gejala_{{ $symptom->id }}">
                        {{ $symptom->code }} - {{ $symptom->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>


    <div class="mb-3">
        <label class="form-label">Solusi</label>
        <textarea name="solution" class="form-control" rows="4">{{ old('solution') }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('penyakit.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
