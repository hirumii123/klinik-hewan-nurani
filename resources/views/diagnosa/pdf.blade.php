@php
    // Karena pakai session, data sudah berupa objek/array
    $cfUserInputs = $cfUserInputs ?? [];
    $results = $results ?? []; // Now it's $results instead of $diseases
@endphp

@if (empty($results))
    <p><strong>❌ Data hasil diagnosa tidak ditemukan.</strong></p>
@else
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Hasil Diagnosa Kucing - Klinik Hewan Nurani</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap');

            body {
                font-family: 'Roboto', sans-serif;
                font-size: 12px;
                margin: 0;
                padding: 0;
                line-height: 1.6;
                color: #333;
            }
            .container {
                width: 90%;
                margin: 20px auto;
                padding: 30px;
                border: 1px solid #ddd; /* Softer border */
                box-shadow: 0 0 10px rgba(0,0,0,0.05); /* Softer shadow */
                background-color: #fff;
            }
            .header {
                text-align: center;
                margin-bottom: 30px;
                padding-bottom: 20px;
                border-bottom: 1px solid #ccc; /* Lighter border */
            }
            .header h1 {
                font-family: 'Merriweather', serif;
                color: #444; /* Darker neutral color */
                font-size: 24px;
                margin: 0;
            }
            .header p {
                font-size: 14px;
                color: #666; /* Softer neutral color */
                margin: 5px 0 0;
            }
            .section-title {
                font-family: 'Merriweather', serif;
                color: #555; /* Neutral color for titles */
                font-size: 16px;
                margin-top: 25px;
                margin-bottom: 10px;
                border-bottom: 1px dashed #eee; /* Very light dashed border */
                padding-bottom: 5px;
            }
            .info-box {
                background-color: #f9f9f9; /* Very light background */
                border: 1px solid #eee; /* Light border */
                padding: 15px;
                margin-bottom: 20px;
                border-radius: 5px;
            }
            ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }
            ul li {
                margin-bottom: 5px;
                padding-left: 15px;
                position: relative;
            }
            ul li:before {
                content: '•';
                color: #888; /* Neutral bullet color */
                position: absolute;
                left: 0;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 15px;
            }
            table, th, td {
                border: 1px solid #ddd;
            }
            th, td {
                padding: 10px;
                text-align: left;
            }
            th {
                background-color: #f5f5f5; /* Light gray header */
                color: #333;
                font-weight: bold;
            }
            .alert-message {
                background-color: #f0f8ff; /* Very light blue */
                border-left: 4px solid #a8d1f7; /* Soft blue border */
                padding: 10px;
                margin-top: 15px;
                color: #333;
                border-radius: 3px;
            }
            .solution-box {
                background-color: #f8fcf8; /* Very light green */
                border: 1px solid #e0ffe0; /* Soft green border */
                padding: 15px;
                margin-top: 20px;
                border-radius: 5px;
                color: #333; /* Keep text dark for readability */
            }
            .solution-box h6 {
                color: #555; /* Neutral color for solution title */
                margin-top: 0;
            }
            .step-by-step {
                background-color: #f2f2f2; /* Light gray */
                padding: 15px;
                border-radius: 5px;
                margin-top: 20px;
            }
            .step-by-step pre {
                white-space: pre-wrap;
                word-wrap: break-word;
                font-size: 11px;
                background-color: #e8e8e8; /* Slightly darker gray for code blocks */
                padding: 10px;
                border-radius: 3px;
            }
            .footer {
                font-size: 10px;
                color: #777;
                text-align: center;
                margin-top: 40px;
                padding-top: 15px;
                border-top: 1px solid #eee;
            }
            .text-muted {
                color: #777;
            }
            .text-center {
                text-align: center;
            }
            .badge {
                display: inline-block;
                padding: 3px 8px;
                border-radius: 12px;
                font-size: 10px;
                font-weight: bold;
                margin-top: 5px;
            }
            /* Softer, more professional badge colors */
            .badge-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb;}
            .badge-primary { background-color: #cfe2ff; color: #052c65; border: 1px solid #b6d4fe;}
            .badge-warning { background-color: #fff3cd; color: #664d03; border: 1px solid #ffecb5;}
            .badge-danger { background-color: #f8d7da; color: #58151c; border: 1px solid #f5c2c7;}

            /* Add spacing between individual disease details, but remove page breaks */
            .disease-detail-section {
                margin-bottom: 30px; /* Space between each disease's detail block */
                padding-bottom: 20px; /* Padding at the bottom of the section */
                border-bottom: 1px dashed #eee; /* Separator line */
            }
            .disease-detail-section:last-of-type {
                border-bottom: none; /* No separator after the last one */
                margin-bottom: 0;
                padding-bottom: 0;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Hasil Diagnosa Kucing</h1>
                <p>Klinik Hewan Nurani</p>
                <p class="text-muted">Hasil diagnosa ini bersifat indikatif dan tidak sepenuhnya akurat. Selalu konsultasikan dengan dokter hewan profesional untuk diagnosa dan penanganan lebih lanjut.</p>
            </div>

            <h4 class="section-title">Ringkasan Hasil Diagnosa:</h4>
            <div class="info-box">
                <table>
                    <thead>
                        <tr>
                            <th>Kode Penyakit</th>
                            <th>Nama Penyakit</th>
                            <th>Nilai CF</th>
                            <th>Persentase (%)</th>
                            <th>Tingkat Kepastian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $item)
                            <tr>
                                <td>{{ $item['disease']->code ?? 'N/A' }}</td>
                                <td>{{ $item['disease']->name ?? 'N/A' }}</td>
                                <td><strong>{{ $item['cf'] ?? '0.0' }}</strong></td>
                                <td><strong>{{ $item['percentage'] ?? '0' }}%</strong></td>
                                <td>
                                    @if(($item['cf'] ?? 0) >= 0.8)
                                        <span class="badge badge-success">Sangat Yakin</span>
                                    @elseif(($item['cf'] ?? 0) >= 0.6)
                                        <span class="badge badge-primary">Yakin</span>
                                    @elseif(($item['cf'] ?? 0) >= 0.4)
                                        <span class="badge badge-warning">Ragu-ragu</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Yakin</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <h4 class="section-title">Gejala yang Dipilih:</h4>
            <div class="info-box">
                @if(!empty($cfUserInputs))
                    <ul>
                        @foreach ($cfUserInputs as $code => $cf)
                            <li>{{ $code }} - {{ \App\Models\Symptom::where('code', $code)->value('name') }} (Keyakinan: {{ $cf * 100 }}%)</li>
                        @endforeach
                    </ul>
                @else
                    <p>Tidak ada gejala yang dipilih.</p>
                @endif
            </div>

            @foreach ($results as $item)
                <div class="disease-detail-section"> {{-- New wrapper div for each disease's details --}}
                    <h4 class="section-title">Detail untuk Penyakit: {{ $item['disease']->name ?? 'N/A' }} ({{ $item['percentage'] ?? '0' }}%)</h4>

                    @if(isset($item['details']) && count($item['details']) > 0)
                        <h6>Rincian Gejala & Perhitungan CF:</h6>
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Gejala</th>
                                    <th>Nama Gejala</th>
                                    <th>CF Expert</th>
                                    <th>CF User</th>
                                    <th>CF Gejala (CFuser x CFexpert)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item['details'] as $detail)
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
                    @endif

                    @if(isset($item['steps']) && is_array($item['steps']) && count($item['steps']) > 0)
                        <h6 style="margin-top: 15px;">Step-by-step Kombinasi CF:</h6>
                        <div class="step-by-step">
                            @if(count($item['steps']) == 1 && strpos($item['steps'][0], 'Forward Chaining') !== false)
                                <p><strong>{{ $item['steps'][0] }}</strong></p>
                                <p>Diagnosa ditentukan langsung berdasarkan pola gejala spesifik yang terdeteksi dalam sistem.</p>
                            @else
                                <pre>{{ implode("\n", $item['steps']) }}</pre>
                            @endif
                        </div>
                    @else
                        <div class="alert-message">
                            <p>Tidak ada detail proses perhitungan yang tersedia.</p>
                        </div>
                    @endif

                    @if(isset($item['disease']->solution) && !empty($item['disease']->solution))
                        <h6 style="margin-top: 15px;">Rekomendasi Solusi:</h6>
                        <div class="solution-box">
                            <div>{!! nl2br(e($item['disease']->solution)) !!}</div>
                        </div>
                    @else
                        <div class="alert-message">
                            <p class="text-muted fst-italic">Belum ada solusi untuk penyakit ini.</p>
                        </div>
                    @endif
                </div> {{-- End of new wrapper div --}}
            @endforeach

            <div class="footer">
                <p>
                    Dokumen ini dihasilkan oleh Sistem Pakar Diagnosa Penyakit Kucing pada {{ date('d/m/Y H:i') }}<br>
                    Hasil diagnosa ini bersifat indikatif dan sebaiknya dikonsultasikan dengan dokter hewan profesional.
                </p>
            </div>
        </div>
    </body>
    </html>
@endif
