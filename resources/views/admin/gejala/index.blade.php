@extends('layouts.admin')

@section('title', 'Gejala')

@section('content')
<h2 class="mb-4">🧾 Daftar Gejala</h2>

<a href="{{ route('gejala.create') }}" class="btn btn-primary mb-3">+ Tambah Gejala</a>

<div class="table-responsive"> {{-- Tambahkan div responsive untuk tabel --}}
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th style="width: 5%">Kode</th>
                <th>Nama Gejala</th>
                <th>Kategori Gejala</th>
                <th style="width: 15%">Gambar</th> {{-- Kolom baru untuk gambar --}}
                <th style="width: 15%">Sumber Gambar</th> {{-- Kolom baru untuk sumber gambar --}}
                <th style="width: 20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gejalas as $gejala)
                <tr>
                    <td>{{ $gejala->code }}</td>
                    <td>{{ $gejala->name }}</td>
                    <td>{{ $gejala->kategori->name ?? '-' }}</td>
                    <td>
                        @if ($gejala->image)
                            <img src="{{ asset($gejala->image) }}" alt="Gambar Gejala" style="width: 80px; height: auto; object-fit: cover; border-radius: 5px;">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $gejala->image_source ?? '-' }}</td> {{-- Tampilkan sumber gambar --}}
                    <td>
                        <div class="d-flex gap-2 justify-content-start">
                            <a href="{{ route('gejala.edit', $gejala->id) }}" class="btn btn-sm"><img src="{{ asset('images/edit.png') }}" width="24"><span> Edit</span></a>
                            <form action="{{ route('gejala.destroy', $gejala->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm"><img src="{{ asset('images/delete.png') }}" width="24"><span> Delete</span></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
