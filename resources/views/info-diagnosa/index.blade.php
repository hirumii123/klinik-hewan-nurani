@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center mb-5">
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold mb-3">Diagnosa Penyakit Kucing</h1>
            <p class="lead">Sistem pakar untuk mendiagnosa berbagai penyakit pada kucing kesayangan Anda dengan metode Certainty Factor (CF) dan Forward Chaining.</p>
            <div class="d-grid gap-2 d-md-flex mt-4">
                <a href="{{ route('diagnosa.index') }}" class="btn btn-primary btn-lg px-4">
                    <i class="bi bi-clipboard2-pulse me-2"></i>Diagnosa Sekarang
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
                        <div class="col-md-4">
                            <div class="card h-100 border-0 bg-light">
                                <div class="card-body text-center">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                        <i class="bi bi-list-check fs-4"></i>
                                    </div>
                                    <h4 class="card-title">1. Pilih Gejala</h4>
                                    <p class="card-text">Pilih gejala-gejala yang dialami oleh kucing Anda pada form diagnosa.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card h-100 border-0 bg-light">
                                <div class="card-body text-center">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                        <i class="bi bi-ui-checks fs-4"></i>
                                    </div>
                                    <h4 class="card-title">2. Tentukan Kepastian</h4>
                                    <p class="card-text">Tentukan tingkat keyakinan Anda terhadap gejala yang dipilih.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card h-100 border-0 bg-light">
                                <div class="card-body text-center">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                        <i class="bi bi-file-earmark-medical fs-4"></i>
                                    </div>
                                    <h4 class="card-title">3. Dapatkan Hasil</h4>
                                    <p class="card-text">Lihat hasil diagnosa penyakit kucing dan rekomendasi penanganan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow rounded-4">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4">Tentang Sistem Pakar Diagnosa Penyakit Kucing</h2>
                    <p class="lead">Sistem ini dikembangkan menggunakan metode <strong>Certainty Factor (CF)</strong> dan <strong>Forward Chaining</strong> untuk memberikan diagnosa yang akurat berdasarkan gejala-gejala yang diamati.</p>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h4><i class="bi bi-check-circle-fill text-success me-2"></i>Metode Certainty Factor</h4>
                            <p>Metode CF mempertimbangkan tingkat keyakinan pakar dan pengguna terhadap gejala yang diamati, menghasilkan nilai kepastian untuk setiap kemungkinan penyakit.</p>
                        </div>
                        <div class="col-md-6">
                            <h4><i class="bi bi-diagram-3-fill text-primary me-2"></i>Metode Forward Chaining</h4>
                            <p>Metode ini menerapkan penalaran maju, dimulai dari gejala yang diamati kemudian menarik kesimpulan mengenai penyakit yang mungkin dialami.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
