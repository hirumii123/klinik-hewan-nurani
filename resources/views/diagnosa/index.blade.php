@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow rounded-4">
        <div class="card-body p-5">
            <h2 class="mb-4 text-primary text-center">🩺 Diagnosa Penyakit Kucing</h2>
            <p class="text-muted text-center mb-4">Silakan pilih gejala yang dialami kucing Anda berdasarkan area tubuh kucing.</p>

            <!-- Progress Bar -->
            <div class="progress mb-4" style="height: 20px;">
                <div id="progress-bar" class="progress-bar bg-custom-biru" role="progressbar" style="width: 5%;" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <form id="symptom-form" action="{{ route('diagnosa.konfirmasi') }}" method="POST">
                @csrf

                @php $step = 1; @endphp
                @foreach ($symptoms as $kategori => $listGejala)
                    <div class="step" data-step="{{ $step }}" style="display: {{ $step === 1 ? 'block' : 'none' }};">
                        <h4 class="text-secondary mb-3">{{ $kategori }}</h4>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                            @foreach ($listGejala as $symptom)
                                <div class="col">
                                    {{-- Tambahkan kelas 'symptom-card-container' untuk menampung efek hover --}}
                                    <label class="card h-100 shadow-sm symptom-card p-3" for="{{ $symptom->code }}" style="cursor: pointer;">
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input d-none" type="checkbox" name="symptoms[]" value="{{ $symptom->code }}" id="{{ $symptom->code }}">
                                            <span class="fw-semibold flex-grow-1">{{ $symptom->code }} - {{ $symptom->name }}</span>
                                        </div>

                                        {{-- Bagian gambar dan sumber yang akan tampil saat hover --}}
                                        @if ($symptom->image)
                                            <div class="symptom-image-info mt-2 text-center">
                                                <img src="{{ asset($symptom->image) }}" alt="{{ $symptom->name }}" class="img-fluid rounded" style="max-height: 100px; display: block; margin: 0 auto;">
                                                @if ($symptom->image_source)
                                                    <small class="text-muted d-block mt-1">Sumber: {{ $symptom->image_source }}</small>
                                                @endif
                                            </div>
                                        @endif
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @php $step++; @endphp
                @endforeach

                <div class="d-flex justify-content-between mt-5">
                    <button type="button" id="prev-btn" class="btn btn-secondary" disabled>Sebelumnya</button>
                    <button type="button" id="next-btn" class="btn btn-primary">Selanjutnya</button>
                    <button type="submit" id="submit-btn" class="btn btn-success d-none">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const steps = document.querySelectorAll('.step');
    const nextBtn = document.getElementById('next-btn');
    const prevBtn = document.getElementById('prev-btn');
    const submitBtn = document.getElementById('submit-btn');
    const progressBar = document.getElementById('progress-bar');

    let currentStep = 1;
    const totalSteps = steps.length;

    function updateStepDisplay() {
        steps.forEach(step => {
            step.style.display = (parseInt(step.dataset.step) === currentStep) ? 'block' : 'none';
        });

        prevBtn.disabled = currentStep === 1;

        if (currentStep === totalSteps) {
            nextBtn.classList.add('d-none');
            submitBtn.classList.remove('d-none');
        } else {
            nextBtn.classList.remove('d-none');
            submitBtn.classList.add('d-none');
        }

        const progress = Math.round((currentStep / totalSteps) * 100);
        progressBar.style.width = progress + '%';
        progressBar.setAttribute('aria-valuenow', progress);
        progressBar.innerText = progress + '%';
    }

    nextBtn.addEventListener('click', () => {
        if (currentStep < totalSteps) {
            currentStep++;
            updateStepDisplay();
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep--;
            updateStepDisplay();
        }
    });

    updateStepDisplay();

    document.querySelectorAll('.symptom-card').forEach(card => {
        const input = card.querySelector('input[type="checkbox"]');

        card.addEventListener('click', (e) => {
            if (e.target.tagName !== 'A' && e.target.tagName !== 'BUTTON' && e.target.tagName !== 'INPUT') {
                input.checked = !input.checked;
                card.classList.toggle('active', input.checked);
                e.preventDefault();
            }
        });

        if (input.checked) {
            card.classList.add('active');
        }
    });
</script>
@endpush
