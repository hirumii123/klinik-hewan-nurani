@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow rounded-4">
        <div class="card-body p-5">
            <h2 class="mb-4 text-primary">Hasil Diagnosa Kucing</h2>
            <p class="text-muted mb-4"><small>Hasil diagnosa ini bersifat indikatif dan tidak sepenuhnya akurat. Selalu konsultasikan dengan dokter hewan profesional untuk diagnosa dan penanganan lebih lanjut.</small></p>

            {{-- Gejala yang Dipilih --}}
            <div class="mb-4">
                <h5 class="mobile-small-heading">Gejala yang Dipilih:</h5> {{-- Perubahan di sini --}}
                <ul class="list-group list-group-flush">
                    @foreach ($cfUserInputs as $code => $cf)
                        <li class="list-group-item">
                            <strong>{{ $code }}</strong> - {{ \App\Models\Symptom::where('code', $code)->value('name') }}
                            <span class="float-end text-muted">Tingkat Keyakinan Gejala: {{ $cf * 100 }}%</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Hasil Diagnosa --}}
            @if(count($results) > 0)
                <div class="alert alert-success">
                    Ditemukan {{ count($results) }} kemungkinan penyakit berdasarkan gejala yang dipilih.
                </div>

                {{-- Wrap table with table-responsive for horizontal scrolling on small screens --}}
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Kode Penyakit</th>
                                <th>Nama Penyakit</th>
                                <th>Nilai CF</th>
                                <th>Persentase (%)</th>
                                <th>Tingkat Kepastian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                                <tr>
                                    <td>{{ $result['disease']->code }}</td>
                                    <td>{{ $result['disease']->name }}</td>
                                    <td><strong>{{ $result['cf'] }}</strong></td>
                                    <td><strong>{{ $result['percentage'] }}%</strong></td>
                                    <td>
                                        @if($result['cf'] >= 0.8)
                                            <span class="badge bg-success">Yakin</span>
                                        @elseif($result['cf'] >= 0.6)
                                            <span class="badge bg-primary">Sedang</span>
                                        @elseif($result['cf'] >= 0.4)
                                            <span class="badge bg-warning text-dark">Ragu-ragu</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Yakin</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Detail Perhitungan untuk setiap penyakit --}}
                @foreach ($results as $index => $result)
                    <div class="card mb-5 mt-4 border-primary">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="m-0 mobile-small-heading">{{ $result['disease']->code }} - {{ $result['disease']->name }} ({{ $result['percentage'] }}%)</h5> {{-- Perubahan di sini --}}
                            <button class="btn text-white rounded-full" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseDetail{{ $index }}" aria-expanded="false"
                                    aria-controls="collapseDetail{{ $index }}">
                                <i class="bi bi-chevron-down"></i>
                                <span class="d-none d-sm-inline">Lihat Detail & Solusi</span>
                                <span class="d-inline d-sm-none">Detail & Solusi</span> {{-- Shorter text for small screens --}}
                            </button>
                        </div>

                        <div class="collapse" id="collapseDetail{{ $index }}">
                            <div class="card-body">
                                <h6 class="mb-3">Rincian Gejala & Perhitungan CF:</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Kode Gejala</th>
                                                <th>Nama Gejala</th>
                                                <th>CF Expert</th>
                                                <th>CF User</th>
                                                <th>CF Gejala (CFuser x CFexpert)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($result['details'] as $detail)
                                                <tr>
                                                    <td>{{ $detail['symptom_code'] }}</td>
                                                    <td>{{ $detail['symptom_name'] ?? '-' }}</td>
                                                    <td>{{ $detail['cf_expert'] }}</td>
                                                    <td>{{ $detail['cf_user'] }}</td>
                                                    <td>{{ $detail['cf_result'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <h6 class="mb-3 mt-4">Step-by-step Kombinasi CF:</h6>
                                <div class="bg-light p-3 rounded">
                                    <pre class="m-0">{{ implode("\n", $result['steps']) }}</pre>
                                </div>

                                <div class="mt-4">
                                    <h6 class="text-primary">Rekomendasi Solusi:</h6>
                                    @if (!empty($result['disease']->solution))
                                        <div class="p-3 bg-light rounded">
                                            {!! nl2br(e($result['disease']->solution)) !!}
                                        </div>
                                    @else
                                        <p class="text-muted fst-italic">Belum ada solusi untuk penyakit ini.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-warning">
                    Tidak ditemukan penyakit berdasarkan gejala yang dipilih.
                </div>
            @endif
            <hr class="border-1">

            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mt-4 gap-3">
                {{-- Left group of buttons: stack vertically on mobile, horizontally on larger screens --}}
                <div class="d-flex flex-column flex-sm-row gap-2 w-100 w-sm-auto">
                    <a href="{{ route('diagnosa.reset') }}" id="new-diagnosis-btn" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-arrow-repeat"></i> Mulai Diagnosa Baru
                    </a>
                    @if(count($results) > 0 && isset($results[0]['cf']))
                    <form action="{{ route('diagnosa.export') }}" method="POST" target="_blank">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm w-100 w-sm-auto">
                            <i class="bi bi-file-earmark-pdf"></i> Export PDF
                        </button>
                    </form>
                    @endif
                </div>
                {{-- Right button: full width on mobile, auto width on larger screens, with top margin on mobile --}}
                <a href="{{ route('feedback.create') }}" class="btn btn-outline-dark btn-sm mt-2 mt-sm-0 w-100 w-sm-auto">
                    <i class="bi bi-lightbulb"></i> Ada Saran Untuk Kami?
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
