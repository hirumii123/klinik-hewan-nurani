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
        <label class="form-label">Gejala</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $disease->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Solusi</label>
        <textarea name="solution" class="form-control" rows="4">{{ old('solution', $disease->solution) }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('penyakit.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
