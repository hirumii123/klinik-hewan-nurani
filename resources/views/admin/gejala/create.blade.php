    @extends('layouts.admin')

    @section('title', 'Tambah gejala')

    @section('content')
    <h2 class="mb-4">➕ Tambah gejala Baru</h2>

    <form action="{{ route('gejala.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Kode gejala</label>
            <input type="text" name="code" class="form-control" value="{{ old('code') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama gejala</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
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


        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('gejala.index') }}" class="btn btn-secondary">Batal</a>
    </form>
    @endsection
