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
                            </select>
                    </div>
                @endforeach

                <button type="submit" id="submitResultBtn" class="btn btn-primary mt-3">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                    <span class="button-text">Lihat Hasil Diagnosa</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const konfirmasiForm = document.querySelector('form');
    const submitResultBtn = document.getElementById('submitResultBtn');

    konfirmasiForm.addEventListener('submit', function() {
        submitResultBtn.disabled = true;
        submitResultBtn.querySelector('.spinner-border').style.display = 'inline-block';
        submitResultBtn.querySelector('.button-text').innerText = 'Loading...';
    });
</script>
@endpush
