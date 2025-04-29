@extends('layouts.admin')

@section('title', 'Edit gejala')

@section('content')
<h2 class="mb-4">✏️ Edit gejala</h2>

<form action="{{ route('gejala.update', $gejala->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Kode gejala</label>
        <input type="text" name="code" class="form-control" value="{{ old('code', $gejala->code) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama gejala</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $gejala->name) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="kategori" class="form-select" required>
            @foreach ($kategoriList as $kategori)
                <option value="{{ $kategori }}" {{ old('kategori', $gejala->kategori ?? '') == $kategori ? 'selected' : '' }}>
                    {{ $kategori }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('gejala.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
