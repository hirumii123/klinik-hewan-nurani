<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Symptom;
use App\Models\Rule;
use App\Models\Disease;
use Barryvdh\DomPDF\Facade\Pdf;

class DiagnosaController extends Controller
{
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

        // Menghapus validasi minimal satu gejala
        // if (empty($selectedCodes)) {
        //     return redirect()->route('diagnosa.index')
        //         ->with('error', 'Silakan pilih minimal satu gejala untuk melakukan diagnosa.');
        // }

        $selectedSymptoms = Symptom::whereIn('code', $selectedCodes)->get();
        $noSymptomsSelected = $selectedSymptoms->isEmpty(); // Menentukan apakah tidak ada gejala yang dipilih

        return view('diagnosa.konfirmasi', compact('selectedSymptoms', 'noSymptomsSelected'));
    }

    public function hasil(Request $request)
    {
        $cfUserInputs = $request->input('cf_user', []);

        // Menangani jika tidak ada gejala yang dipilih atau semua dihapus di halaman konfirmasi
        if (empty($cfUserInputs)) {
            $results = [[
                'disease' => (object)['code' => 'N/A', 'name' => 'Kucing Sehat', 'solution' => 'Tidak ada penyakit terdeteksi berdasarkan gejala yang dipilih. Terus pantau kesehatan kucing Anda.'],
                'cf' => 0.0,
                'percentage' => 0,
                'details' => [],
                'steps' => ['Tidak ada gejala yang dipilih.']
            ]];

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

        $symptomIds = Symptom::whereIn('code', array_keys($cfUserInputs))->pluck('id', 'code')->toArray();
        $rules = Rule::whereIn('symptom_id', $symptomIds)->get();

        $cfValues = [];
        $details = [];

        foreach ($rules as $rule) {
            $symptomCode = array_search($rule->symptom_id, $symptomIds);
            $cfUser = floatval($cfUserInputs[$symptomCode] ?? 0);
            $cfExpert = $rule->cf_value;
            $cfHitung = $cfUser * $cfExpert;
            $diseaseId = $rule->disease_id;

            $cfValues[$diseaseId][] = $cfHitung;

            $details[$diseaseId][] = [
                'symptom_code' => $symptomCode,
                'symptom_name' => Symptom::where('code', $symptomCode)->value('name'),
                'cf_expert' => $cfExpert,
                'cf_user' => $cfUser,
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

        usort($results, fn($a, $b) => $b['cf'] <=> $a['cf']);

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

        $diseases = isset($result['diseases']) ? $result['diseases'] : [isset($result['disease']) ? $result['disease'] : null];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('diagnosa.pdf', [
            'result' => (object) $result,
            'cfUserInputs' => $cfUserInputs,
            'diseases' => $diseases,
        ])->setPaper('a4', 'portrait');

        session()->forget(['hasil_diagnosa', 'cf_user_inputs']);

        return $pdf->download('hasil_diagnosa_kucing.pdf');
    }

}
