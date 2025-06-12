{{-- resources/views/feedback/create.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow rounded-4 p-4">
        <h2 class="mb-4 text-primary text-center">📝 Berikan Saran Anda</h2>
        <p class="text-muted text-center mb-4">Jika diagnosa tidak sesuai harapan, bantu kami dengan memberikan saran penyakit atau gejala baru.</p>

        <form action="{{ route('feedback.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="suggested_disease" class="form-label">Saran Penyakit</label>
                <input type="text" class="form-control @error('suggested_disease') is-invalid @enderror" id="suggested_disease" name="suggested_disease" value="{{ old('suggested_disease') }}" placeholder="Contoh: Virus Panleukopenia Baru">
                @error('suggested_disease')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="suggested_symptoms" class="form-label">Saran Gejala</label>
                <textarea class="form-control @error('suggested_symptoms') is-invalid @enderror" id="suggested_symptoms" name="suggested_symptoms" rows="5" placeholder="Contoh: Mata kuning, lesu, diare parah...">{{ old('suggested_symptoms') }}</textarea>
                @error('suggested_symptoms')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Kirim Saran</button>
            </div>
        </form>
    </div>
</div>
@endsection
