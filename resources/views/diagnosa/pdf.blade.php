@php
    // Karena pakai session, data sudah berupa objek/array
    $cfUserInputs = $cfUserInputs ?? [];
    $diseases = $diseases ?? [];
@endphp

@if (!$result)
    <p><strong>❌ Data hasil diagnosa tidak ditemukan.</strong></p>
@else
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Hasil Diagnosa PDF</title>
        <style>
            body { font-family: 'Roboto', sans-serif; font-size: 12px; margin: 0; padding: 0; }
            h2 { color: #2e6da4; font-size: 18px; }
            h4 { color: #2e6da4; font-size: 16px; }
            p { line-height: 1.5; }
            table { width: 100%; border-collapse: collapse; margin-top: 15px; }
            table, th, td { border: 1px solid #ddd; }
            th, td { padding: 8px; text-align: left; }
            th { background-color: #f2f2f2; }
            .special-note { padding: 10px; background-color: #f5f5f5; border-left: 4px solid #2e6da4; margin: 10px 0; }
            .footer { font-size: 10px; color: #777; text-align: center; margin-top: 30px; border-top: 1px solid #ddd; padding-top: 10px; }
            .alert { background-color: #f9f9f9; padding: 10px; border: 1px solid #ddd; }
            .alert-success { border-left: 4px solid #28a745; }
            .alert-danger { border-left: 4px solid #dc3545; }
        </style>
    </head>
    <body>
        <h2>Hasil Diagnosa Kucing Klinik Hewan Nurani</h2>

        <p><strong>Penyakit yang Terdiagnosis:</strong></p>
        @if(count($diseases) > 0)
            <ul>
                @foreach ($diseases as $disease)
                    <li>
                        <strong>{{ $disease->code }} - {{ $disease->name }}</strong><br>
                        <em>{{ $disease->description ?? 'Deskripsi tidak tersedia.' }}</em>
                    </li>
                @endforeach
            </ul>
        @else
            <p><em>Tidak ada penyakit yang terdeteksi.</em></p>
        @endif

        <p><strong>Nilai CF:</strong> {{ $result->cf }} ({{ $result->percentage }}%)</p>

        <h4>Gejala yang Dipilih:</h4>
        <ul>
            @foreach ($cfUserInputs as $code => $cf)
                <li>{{ $code }} - {{ \App\Models\Symptom::where('code', $code)->value('name') }} (Keyakinan: {{ $cf * 100 }}%)</li>
            @endforeach
        </ul>

        @if(isset($result->details) && count($result->details) > 0)
            <h4>Detail Perhitungan CF:</h4>
            <table>
                <thead>
                    <tr>
                        <th>Kode Gejala</th>
                        <th>Nama Gejala</th>
                        <th>CF Expert</th>
                        <th>CF User</th>
                        <th>CF ×</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result->details as $detail)
                        <tr>
                            <td>{{ $detail['symptom_code'] }}</td>
                            <td>{{ $detail['symptom_name'] }}</td>
                            <td>{{ $detail['cf_expert'] }}</td>
                            <td>{{ $detail['cf_user'] }}</td>
                            <td>{{ $detail['cf_result'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @if(isset($result->steps) && is_array($result->steps) && count($result->steps) > 0)
            @if(count($result->steps) == 1 && strpos($result->steps[0], 'Forward Chaining') !== false)
                <div class="special-note">
                    <p><strong>{{ $result->steps[0] }}</strong></p>
                    <p>Diagnosa ditentukan langsung berdasarkan pola gejala spesifik yang terdeteksi dalam sistem.</p>
                </div>
            @else
                <h4>Step-by-step Kombinasi CF:</h4>
                <ul>
                    @foreach ($result->steps as $step)
                        <li>{{ $step }}</li>
                    @endforeach
                </ul>
            @endif
        @else
            <p>Tidak ada detail proses perhitungan yang tersedia.</p>
        @endif

        <div class="footer">
            <p>
                Dokumen ini dihasilkan oleh Sistem Pakar Diagnosa Penyakit Kucing pada {{ date('d/m/Y H:i') }}<br>
                Hasil diagnosa ini bersifat indikatif dan sebaiknya dikonsultasikan dengan dokter hewan profesional.
            </p>
        </div>
    </body>
    </html>
@endif
