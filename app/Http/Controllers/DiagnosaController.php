<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Symptom;
use App\Models\Rule;
use App\Models\Disease;
use Barryvdh\DomPDF\Facade\Pdf;

class DiagnosaController extends Controller
{
    // Tampilkan form gejala
    public function index()
    {
        $symptoms = Symptom::with('kategori')
            ->orderBy('kategori_id')
            ->orderBy('code')
            ->get()
            ->groupBy(fn($item) => $item->kategori->name ?? 'Tanpa Kategori');

        return view('diagnosa.index', compact('symptoms'));
    }

    // Halaman konfirmasi untuk input CF user
    public function konfirmasi(Request $request)
    {
        $selectedCodes = $request->input('symptoms', []);

        // Validasi jika tidak ada gejala yang dipilih
        if (empty($selectedCodes)) {
            return redirect()->route('diagnosa.index')
                ->with('error', 'Silakan pilih minimal satu gejala untuk melakukan diagnosa.');
        }

        $selectedSymptoms = Symptom::whereIn('code', $selectedCodes)->get();
        return view('diagnosa.konfirmasi', compact('selectedSymptoms'));
    }

    // Proses hasil diagnosa
    public function hasil(Request $request)
    {
        $cfUserInputs = $request->input('cf_user', []);
        if (empty($cfUserInputs)) {
            return redirect()->route('diagnosa.index')
                ->with('error', 'Terjadi kesalahan. Silakan ulangi proses diagnosa.');
        }

        // 🔍 Jalankan tree forward chaining (shortcut)
        $shortcutCode = $this->checkTreeShortcut($cfUserInputs);
        if ($shortcutCode) {
            $shortcutPenyakit = Disease::where('code', $shortcutCode)->first();

            $shortcutResult = [
                'disease' => $shortcutPenyakit,
                'cf' => 1.0,
                'percentage' => 100,
                'details' => [],
                'steps' => ['🧠 Dideteksi langsung melalui struktur pohon (Forward Chaining).']
            ];

            session()->forget(['hasil_diagnosa', 'cf_user_inputs']);
            session([
                'hasil_diagnosa' => $shortcutResult,
                'cf_user_inputs' => $cfUserInputs
            ]);

            return view('diagnosa.hasil', [
                'results' => [$shortcutResult],
                'cfUserInputs' => $cfUserInputs
            ]);
        }

        // 🔢 Lanjut ke perhitungan Certainty Factor (CF)
        $symptomIds = Symptom::whereIn('code', array_keys($cfUserInputs))->pluck('id', 'code')->toArray();
        $rules = Rule::whereIn('symptom_id', $symptomIds)->get();

        $cfValues = [];
        $details = [];

        // BOBOT KEUNIKAN
        // $gejalaPenyakitMap = Rule::all()->groupBy('symptom_id');
        // $bobotKeunikan = [];

        // foreach ($gejalaPenyakitMap as $symptomId => $rulesGroup) {
        //     $jumlahPenyakit = $rulesGroup->pluck('disease_id')->unique()->count();
        //     $bobotKeunikan[$symptomId] = $jumlahPenyakit > 0 ? round(1 / $jumlahPenyakit, 3) : 1.0;
        // }

        foreach ($rules as $rule) {
            $symptomCode = array_search($rule->symptom_id, $symptomIds);
            $cfUser = floatval($cfUserInputs[$symptomCode] ?? 0);
            $cfExpert = $rule->cf_value;

            // BOBOT KEUNIKAN
            // $bobot = $bobotKeunikan[$rule->symptom_id] ?? 1.0;
            // $cfHitung = $cfUser * $cfExpert * $bobot;


            $cfHitung = $cfUser * $cfExpert;
            $diseaseId = $rule->disease_id;

            $cfValues[$diseaseId][] = $cfHitung;

            $details[$diseaseId][] = [
                'symptom_code' => $symptomCode,
                'symptom_name' => Symptom::where('code', $symptomCode)->value('name'),
                'cf_expert' => $cfExpert,
                'cf_user' => $cfUser,
                // 'bobot_keunikan' => $bobot,
                'cf_result' => round($cfHitung, 3)
            ];
        }

        $results = [];

        foreach ($cfValues as $diseaseId => $cfList) {
            $cfCombine = $cfList[0];
            $stepExplanation = ["CF1 = {$cfCombine}"];

            for ($i = 1; $i < count($cfList); $i++) {
                $prev = $cfCombine;
                $cfCombine = $cfCombine + $cfList[$i] * (1 - $cfCombine);
                $stepExplanation[] = "CF" . ($i + 1) . " = {$cfList[$i]} → CF = {$prev} + {$cfList[$i]} × (1 - {$prev}) = " . round($cfCombine, 4);
            }

            $results[] = [
                'disease' => Disease::find($diseaseId),
                'cf' => round($cfCombine, 3),
                'percentage' => round($cfCombine * 100, 2),
                'details' => $details[$diseaseId] ?? [],
                'steps' => $stepExplanation
            ];
        }

        // Urutkan & ambil hasil CF tertinggi
        usort($results, fn($a, $b) => $b['cf'] <=> $a['cf']);
        // $results = array_slice($results, 0, 1);

        session()->forget(['hasil_diagnosa', 'cf_user_inputs']);
        session([
            'hasil_diagnosa' => $results[0],
            'cf_user_inputs' => $cfUserInputs
        ]);

        return view('diagnosa.hasil', [
            'results' => $results,
            'cfUserInputs' => $cfUserInputs
        ]);
    }


    // Fungsi shortcut berdasarkan tree forward chaining
    private function checkTreeShortcut(array $cfUserInputs): ?string
    {
        $shortcutRules = \App\Models\ShortcutRule::all();

    foreach ($shortcutRules as $rule) {
        $codes = $rule->symptom_codes;
        $penyakitCode = $rule->disease_code;

        $semuaTerpenuhi = true;
        foreach ($codes as $code) {
            if (!isset($cfUserInputs[$code]) || $cfUserInputs[$code] < 0.8) {
                $semuaTerpenuhi = false;
                break;
            }
        }

        if ($semuaTerpenuhi) return $penyakitCode;
    }
        return null;
    }

    public function exportPdf(Request $request)
    {
        $result = session('hasil_diagnosa');
        $cfUserInputs = session('cf_user_inputs');

        if (!$result || !isset($result['disease'])) {
            return abort(400, 'Data diagnosa tidak valid.');
        }

        // Pastikan ada lebih dari satu penyakit di dalam result
        $diseases = isset($result['diseases']) ? $result['diseases'] : [isset($result['disease']) ? $result['disease'] : null];

        // Kirim data ke view
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('diagnosa.pdf', [
            'result' => (object) $result,
            'cfUserInputs' => $cfUserInputs,
            'diseases' => $diseases,  // Pastikan ini array yang berisi penyakit
        ])->setPaper('a4', 'portrait');

        // Menghapus session setelah export PDF
        session()->forget(['hasil_diagnosa', 'cf_user_inputs']);

        return $pdf->download('hasil_diagnosa_kucing.pdf');
    }



}
