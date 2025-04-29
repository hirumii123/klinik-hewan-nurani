@extends('layouts.admin')

@section('title', 'Tree Shortcut')

@section('content')
<h2 class="mb-4">🌳 Daftar Tree Shortcut</h2>

<a href="{{ route('shortcut-rules.create') }}" class="btn btn-primary mb-3">+ Tambah Shortcut</a>

@foreach ($shortcuts as $shortcut)
    <div class="card mb-3">
        <div class="card-header bg-success text-white fw-bold">
            {{ $shortcut->disease_code }} - {{ $shortcut->disease->name ?? '-' }}
        </div>
        <div class="card-body">
            <strong>Gejala:</strong>
            <div class="d-flex flex-wrap gap-2 mt-1">
                @foreach ($shortcut->symptom_codes as $kode)
                    @php
                        $name = \App\Models\Symptom::where('code', $kode)->value('name');
                    @endphp
                    <span class="badge bg-white text-dark border-8-rounded border border-success">
                    {{ $kode }} - {{ $name }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
@endforeach
@endsection
