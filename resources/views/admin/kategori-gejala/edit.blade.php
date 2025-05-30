@extends('layouts.admin')

@section('title', 'Edit Kategori Gejala')

@section('content')
<h2 class="mb-4">✏️ Edit Kategori Gejala</h2>

<form action="{{ route('kategori-gejala.update', $kategori) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Nama Kategori Baru</label>
        <input type="text" name="kategori_baru" class="form-control" value="{{ old('kategori_baru', $kategori) }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('kategori-gejala.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
