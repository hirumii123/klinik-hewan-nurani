@extends('layouts.admin')

@section('title', 'Tambah Kategori Gejala')

@section('content')
<h2 class="mb-4">➕ Tambah Kategori Gejala</h2>

<form action="{{ route('kategori-gejala.store', $kategori) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nama Kategori</label>
        <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('kategori-gejala.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
