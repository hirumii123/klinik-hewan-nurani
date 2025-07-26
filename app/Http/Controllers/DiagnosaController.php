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

    public function konfirmasi(Request $request)
    {
        $selectedCodes = $request->input('symptoms', []);

        $selectedSymptoms = Symptom::whereIn('code', $selectedCodes)->get();
        $noSymptomsSelected = $selectedSymptoms->isEmpty();

        return view('diagnosa.konfirmasi', compact('selectedSymptoms', 'noSymptomsSelected'));
    }

    public function hasil(Request $request)
    {
        $cfUserInputs = $request->input('cf_user', []);

        if (empty($cfUserInputs)) {
            $cfValue = number_format(0.0, 4, '.', '');
            $results = [[
                'disease' => (object)['code' => 'N/A', 'name' => 'Kucing Sehat', 'solution' => 'Tidak ada penyakit'],
                'cf' => $cfValue,
                'percentage' => (float)number_format((float)$cfValue * 100, 2, '.', ''),
                'details' => [],
                'steps' => ['Tidak ada gejala yang dipilih.']
            ]];

            session()->forget(['all_diagnosis_results', 'cf_user_inputs']);
            session([
                'all_diagnosis_results' => $results,
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
            $cfValue = number_format(1.0, 4, '.', '');

            $shortcutResult = [
                'disease' => $shortcutPenyakit,
                'cf' => $cfValue,
                'percentage' => (float)number_format((float)$cfValue * 100, 2, '.', ''),
                'details' => [],
                'steps' => ['🧠 Dideteksi langsung melalui struktur pohon (Forward Chaining).']
            ];

            session()->forget(['all_diagnosis_results', 'cf_user_inputs']);
            session([
                'all_diagnosis_results' => [$shortcutResult],
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
            $stepExplanation = ["CF1 = " . round($cfCombine, 5)];

            for ($i = 1; $i < count($cfList); $i++) {
                $prev = $cfCombine;
                $cfCombine = $cfCombine + $cfList[$i] * (1 - $cfCombine);
                $stepExplanation[] = "CF" . ($i + 1) . " = " . round($cfList[$i], 5) . " → CF = " . round($prev, 5) . " + " . round($cfList[$i], 5) . " × (1 - " . round($prev, 5) . ") = " . round($cfCombine, 5);
            }

            $cfValue = number_format($cfCombine, 4, '.', '');
            $rawPercent = (float) $cfCombine * 100;

            if (intval($rawPercent) == $rawPercent) {
                $percentDisplay = intval($rawPercent);
            } else {
                $percentDisplay = number_format($rawPercent, 2, '.', '');
            }
            $results[] = [
                'disease'    => Disease::find($diseaseId),
                'cf'         => number_format($cfCombine, 4, '.', ''),
                'percentage' => $percentDisplay,
                'details'    => $details[$diseaseId] ?? [],
                'steps'      => $stepExplanation
            ];
        }

        usort($results, fn($a, $b) => $b['cf'] <=> $a['cf']);
        $results = array_slice($results, 0, 3);

        session()->forget(['all_diagnosis_results', 'cf_user_inputs']);
        session([
            'all_diagnosis_results' => $results,
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
        $allResults = session('all_diagnosis_results');
        $cfUserInputs = session('cf_user_inputs');

        if (!$allResults || empty($allResults)) {
            return abort(400, 'Data diagnosa tidak valid atau tidak ditemukan.');
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('diagnosa.pdf', [
            'results' => $allResults,
            'cfUserInputs' => $cfUserInputs,
        ])->setPaper('a4', 'portrait');

        session()->forget(['all_diagnosis_results', 'cf_user_inputs']);

        return $pdf->download('hasil_diagnosa_kucing.pdf');
    }
}
