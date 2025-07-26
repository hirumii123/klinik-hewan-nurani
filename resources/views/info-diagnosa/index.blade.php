@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center mb-5">
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold mb-3">Diagnosis Penyakit Kucing</h1>
            <p class="lead">Sistem pakar untuk mendiagnosa berbagai penyakit pada kucing kesayangan Anda dengan metode Certainty Factor (CF) dan Forward Chaining.</p>
            <div class="d-grid gap-2 d-md-flex mt-4">
                <a href="{{ route('diagnosa.index') }}" class="btn btn-primary2 btn-lg px-4">
                    <i class="bi bi-clipboard2-pulse me-2"></i>Diagnosis Sekarang
                </a>
                <a href="#info" class="btn btn-outline-secondary btn-lg px-4">
                    <i class="bi bi-info-circle me-2"></i>Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
            <img src="{{ asset('images/cat.png') }}" alt="Cat Health">
        </div>
    </div>

    <div class="row mb-5" id="info">
        <div class="col-md-12">
            <div class="card shadow rounded-4">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4">Cara Menggunakan Sistem Pakar</h2>
                    <div class="row g-4">
                        @foreach ([
                            ['icon' => 'bi-list-check', 'title' => '1. Pilih Gejala', 'desc' => 'Pilih gejala-gejala yang dialami oleh kucing Anda pada form diagnosa.'],
                            ['icon' => 'bi-ui-checks', 'title' => '2. Tentukan Kepastian', 'desc' => 'Tentukan tingkat keyakinan Anda terhadap gejala yang dipilih.'],
                            ['icon' => 'bi-file-earmark-medical', 'title' => '3. Dapatkan Hasil', 'desc' => 'Lihat hasil diagnosis penyakit kucing dan rekomendasi penanganan.']
                        ] as $step)
                            <div class="col-md-4">
                                <div class="card h-100 border-0 bg-light">
                                    <div class="card-body text-center">
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                            <i class="bi {{ $step['icon'] }} fs-4"></i>
                                        </div>
                                        <h4 class="card-title">{{ $step['title'] }}</h4>
                                        <p class="card-text">{{ $step['desc'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow rounded-4">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4">Tentang Sistem Pakar Diagnosis Penyakit Kucing</h2>
                    <p class="lead">Sistem ini dikembangkan menggunakan metode <strong>Certainty Factor (CF)</strong> dan <strong>Forward Chaining</strong> untuk memberikan diagnosa yang akurat berdasarkan gejala-gejala yang diamati.</p>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h4><i class="bi bi-check-circle-fill text-primary me-2"></i>Metode Certainty Factor</h4>
                            <p>Mempertimbangkan tingkat keyakinan pakar dan pengguna terhadap gejala yang diamati.</p>
                        </div>
                        <div class="col-md-6">
                            <h4><i class="bi bi-diagram-3-fill text-primary me-2"></i>Metode Forward Chaining</h4>
                            <p>Menarik kesimpulan berdasarkan gejala yang diamati menggunakan penalaran maju.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <h2 class="text-center text-primary mb-4 fw-bold">🧾 Daftar Penyakit</h2>

        <div class="d-flex flex-wrap justify-content-center gap-2 mb-4" id="penyakitTabs">
            @foreach ($diseases as $index => $penyakit)
                <button class="btn btn-outline-primary penyakit-tab {{ $index === 0 ? 'active' : '' }}"
                        data-id="penyakit-{{ $penyakit->id }}">
                    {{ $penyakit->name }}
                </button>
            @endforeach
        </div>

        @foreach ($diseases as $index => $penyakit)
            <div class="card shadow rounded-4 p-4 mb-5 penyakit-content {{ $index !== 0 ? 'd-none' : '' }}"
                 id="penyakit-{{ $penyakit->id }}">
                <h4 class="text-primary fw-bold">Nama Penyakit</h4>
                <p>{{ $penyakit->name }}</p>

                <h5 class="text-primary fw-bold">Gejala</h5>
                @php $items = preg_split('/\r\n|\r|\n/', $penyakit->description); @endphp
                <ul>
                    @foreach ($penyakit->rules as $rule)
                        @if ($rule->symptom)
                            <li>{{ $rule->symptom->name }}</li>
                        @endif
                    @endforeach
                </ul>
                <h5 class="text-primary fw-bold">Solusi</h5>
                <div>{!! nl2br(e($penyakit->solution)) !!}</div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    const tabs = document.querySelectorAll('.penyakit-tab');
    const contents = document.querySelectorAll('.penyakit-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            contents.forEach(c => c.classList.add('d-none'));
            tab.classList.add('active');
            const target = document.getElementById(tab.dataset.id);
            if (target) target.classList.remove('d-none');
        });
    });
</script>
@endpush
