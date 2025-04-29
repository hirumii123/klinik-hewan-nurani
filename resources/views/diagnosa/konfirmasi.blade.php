@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow rounded-4">
        <div class="card-body p-4">
            <h4 class="mb-4">🧠 Seberapa Yakin Kamu Mengalami Gejala Berikut?</h4>

            <form action="{{ route('diagnosa.hasil') }}" method="POST">
                @csrf
                @foreach ($selectedSymptoms as $symptom)
                    <div class="mb-3">
                        <label class="form-label">{{ $symptom->code }} - {{ $symptom->name }}</label>
                        <select name="cf_user[{{ $symptom->code }}]" class="form-select" required>
                            <option value="1.0">Sangat Yakin (100%)</option>
                            <option value="0.8">Yakin (80%)</option>
                            <option value="0.6">Lumayan (60%)</option>
                            <option value="0.4">Cukup (40%)</option>
                            <!-- <option value="0.2">Tidak Tahu (20%)</option> -->
                            <!-- <option value="0.0">Tidak (0%)</option> -->
                        </select>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary mt-3">Lihat Hasil Diagnosa</button>
            </form>
        </div>
    </div>
</div>
@endsection
