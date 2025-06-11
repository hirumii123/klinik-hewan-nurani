@extends('layouts.admin')

@section('title', 'Edit gejala')

@section('content')
<h2 class="mb-4">✏️ Edit gejala</h2>

{{-- Tambahkan enctype="multipart/form-data" untuk unggah file --}}
<form action="{{ route('gejala.update', $gejala->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Kode gejala</label>
        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $gejala->code) }}" required>
        @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Nama gejala</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $gejala->name) }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori Gejala</label>
        <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategoriList as $kategori)
                <option value="{{ $kategori->id }}" {{ $gejala->kategori_id == $kategori->id ? 'selected' : '' }}>
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
        @if ($gejala->image)
            <div class="mb-2">
                <img src="{{ asset($gejala->image) }}" alt="Gambar Gejala" style="max-width: 200px; height: auto;">
                <div class="form-check mt-1">
                    <input class="form-check-input" type="checkbox" name="clear_image" id="clear_image" value="1">
                    <label class="form-check-label" for="clear_image">Hapus Gambar Saat Ini</label>
                </div>
            </div>
        @endif
        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF, SVG. Max ukuran: 2MB. Biarkan kosong untuk tidak mengubah.</small>
    </div>

    <div class="mb-3">
        <label for="image_source" class="form-label">Sumber Gambar (Opsional)</label>
        <input type="text" name="image_source" id="image_source" class="form-control @error('image_source') is-invalid @enderror" value="{{ old('image_source', $gejala->image_source) }}">
        @error('image_source')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('gejala.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
