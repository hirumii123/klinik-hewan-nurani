@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow rounded-4">
        <div class="card-body p-4">
            @if (!$noSymptomsSelected)
                <h4 class="mb-4">🧠 Seberapa Yakin Kamu Mengalami Gejala Berikut?</h4>
            @endif
            <div id="no-symptoms-message" class="text-center py-5 rounded-3" role="alert" style="display: {{ $noSymptomsSelected ? 'block' : 'none' }};">
                <img src="https://cdn.pixabay.com/photo/2014/04/13/20/49/cat-323262_1280.jpg" alt="Kucing Sehat" class="img-fluid rounded mb-3" style="max-width: 200px;">
                <h5 class="fw-bold">😻 Sepertinya kucingmu sehat-sehat saja!</h5>
                <p class="mb-4">Kalau begitu, tetap jaga kesehatannya ya! Tapi kalau ragu, kamu bisa mulai diagnosa ulang kapan saja.</p>
                <a href="{{ route('diagnosa.reset') }}" id="new-diagnosis-btn-message" class="btn btn-primary" style="display: none;">
                    <i class="bi bi-arrow-repeat"></i> Mulai Diagnosa Baru
                </a>
                {{-- Tombol baru untuk feedback --}}
                <a href="{{ route('feedback.create') }}" class="btn btn-outline-dark">
                    <i class="bi bi-lightbulb   "></i>
                    Ada saran untuk kami?
                </a>



            </div>

            <form id="konfirmasi-form" action="{{ route('diagnosa.hasil') }}" method="POST" style="display: {{ $noSymptomsSelected ? 'none' : 'block' }};">
                @csrf
                <div id="symptoms-list">
                    @foreach ($selectedSymptoms as $symptom)
                        <div class="symptom-item mb-3 border p-3 rounded">
                            <label class="form-label fw-bold">{{ $symptom->code }} - {{ $symptom->name }}</label>
                            <div class="d-flex align-items-center">
                                <select name="cf_user[{{ $symptom->code }}]" class="form-select me-2" required>
                                    <option value="1.0">Sangat Yakin (100%)</option>
                                    <option value="0.8">Yakin (80%)</option>
                                    <option value="0.6">Lumayan (60%)</option>
                                    <option value="0.4">Cukup (40%)</option>
                                </select>
                                <button type="button" class="btn-close" aria-label="Close" data-symptom-code="{{ $symptom->code }}"></button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-between mt-4" id="form-buttons-container">
                    <a href="#" onclick="history.back(); return false;" class="btn btn-secondary">
                        Kembali
                    </a>
                    <div class="d-flex gap-2">
                        <a href="{{ route('diagnosa.reset') }}" id="new-diagnosis-btn-in-form" class="btn btn-outline-primary" style="display: none;">
                            <i class="bi bi-arrow-repeat"></i> Mulai Diagnosa Baru
                        </a>
                        <button type="submit" id="submitResultBtn" class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                            <span class="button-text">Lihat Hasil Diagnosa</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const konfirmasiForm = document.getElementById('konfirmasi-form');
        const submitResultBtn = document.getElementById('submitResultBtn');
        const symptomsList = document.getElementById('symptoms-list');
        const noSymptomsMessage = document.getElementById('no-symptoms-message');
        const newDiagnosisBtnInForm = document.getElementById('new-diagnosis-btn-in-form');
        const newDiagnosisBtnMessage = document.getElementById('new-diagnosis-btn-message');

        const updateVisibility = () => {
            const hasSymptoms = symptomsList.children.length > 0;

            konfirmasiForm.style.display = hasSymptoms ? 'block' : 'none';
            noSymptomsMessage.style.display = hasSymptoms ? 'none' : 'block';

            if (newDiagnosisBtnMessage) {
                newDiagnosisBtnMessage.style.display = hasSymptoms ? 'none' : 'inline-block';
            }

            newDiagnosisBtnInForm.style.display = hasSymptoms ? 'inline-block' : 'none';
            submitResultBtn.style.display = hasSymptoms ? 'inline-block' : 'none';
        };

        if (konfirmasiForm) {
            konfirmasiForm.addEventListener('submit', function(event) {
                if (symptomsList.children.length === 0) {
                    event.preventDefault();
                    updateVisibility();
                } else {
                    submitResultBtn.disabled = true;
                    submitResultBtn.querySelector('.spinner-border').style.display = 'inline-block';
                    submitResultBtn.querySelector('.button-text').innerText = 'Loading...';
                }
            });
        }

        document.querySelectorAll('.symptom-item .btn-close').forEach(button => {
            button.addEventListener('click', function() {
                const symptomItem = this.closest('.symptom-item');
                if (symptomItem) {
                    symptomItem.remove();
                    requestAnimationFrame(updateVisibility);
                }
            });
        });

        updateVisibility();
    });
</script>
@endpush
