@extends('layouts.admin')

@section('title', 'Tambah Gejala')

@section('content')
<h2 class="mb-4">➕ Tambah gejala Baru</h2>

{{-- Tambahkan enctype="multipart/form-data" untuk unggah file --}}
<form action="{{ route('gejala.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label">Kode gejala</label>
        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" required>
        @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Nama gejala</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori Gejala</label>
        <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategoriList as $kategori)
                <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->name }}
                </option>
            @endforeach
        </select>
        @error('kategori_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Gambar Gejala (Opsional)</label>
        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF, SVG. Max ukuran: 2MB.</small>
    </div>

    <div class="mb-3">
        <label for="image_source" class="form-label">Sumber Gambar (Opsional)</label>
        <input type="text" name="image_source" id="image_source" class="form-control @error('image_source') is-invalid @enderror" value="{{ old('image_source') }}">
        @error('image_source')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('gejala.index') }}" class="btn btn-secondary">Batal</a>
</form>

@endsection
