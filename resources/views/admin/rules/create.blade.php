@extends('layouts.admin')

@section('title', 'Tambah Rules')

@section('content')
<h2 class="mb-4">➕ Tambah Rules Baru</h2>

<form action="{{ route('rules.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Kode Penyakit</label>
        <input type="text" name="code" class="form-control" value="{{ old('symptom_id') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama Penyakit</label>
        <input type="text" name="name" class="form-control" value="{{ old('disease_id') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">CF Value</label>
        <input type="text" name="name" class="form-control" value="{{ old('cf_value') }}" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('rules.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
