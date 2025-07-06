<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\Rule;

class PenyakitController extends Controller
{
    public function index(Request $request)
    {
        $query = Disease::with(['rules' => function ($query) {
            $query->join('symptoms', 'rules.symptom_id', '=', 'symptoms.id')
                  ->orderBy('symptoms.code', 'asc')
                  ->select('rules.*');
        }])->orderBy('code', 'asc');

        $allDiseases = Disease::orderBy('code', 'asc')->get();
        $allSymptoms = Symptom::orderBy('code', 'asc')->get();

        if ($request->has('filter_disease') && $request->filter_disease != '') {
            $diseaseId = $request->filter_disease;
            $query->where('id', $diseaseId);
        }

        if ($request->has('filter_symptom') && $request->filter_symptom != '') {
            $symptomId = $request->filter_symptom;
            $query->whereHas('rules', function ($q) use ($symptomId) {
                $q->where('symptom_id', $symptomId);
            });
        }

        $diseases = $query->get();

        return view('admin.penyakit.index', compact('diseases', 'allDiseases', 'allSymptoms'));
    }

    public function destroy($id)
    {
        $disease = Disease::findOrFail($id);
        $disease->delete();
        return redirect()->route('penyakit.index')->with('success', 'Penyakit berhasil dihapus.');
    }
    public function create()
    {
        $symptoms = Symptom::orderBy('code')->get();
        return view('admin.penyakit.create', compact('symptoms'));
    }

    public function edit($id)
    {
        $disease = Disease::with('rules')->findOrFail($id);
        $symptoms = Symptom::orderBy('code')->get();
        $selectedSymptoms = $disease->rules->pluck('symptom_id')->toArray();

        return view('admin.penyakit.edit', compact('disease', 'symptoms', 'selectedSymptoms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:diseases,code',
            'name' => 'required',
            'solution' => 'required',
            'symptoms' => 'required|array|min:1'
        ]);

        $disease = Disease::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => '-',
            'solution' => $request->solution
        ]);

        foreach ($request->symptoms as $symptomId) {
            Rule::create([
                'disease_id' => $disease->id,
                'symptom_id' => $symptomId,
                'cf_value' => 0
            ]);
        }

        return redirect()->route('penyakit.index')->with('success', 'Penyakit berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|unique:diseases,code,' . $id,
            'name' => 'required',
            'solution' => 'required',
            'symptoms' => 'required|array|min:1'
        ]);

        $disease = Disease::findOrFail($id);

        // Update detail dasar penyakit
        $disease->update($request->only(['code', 'name', 'description', 'solution']));

        // Dapatkan ID gejala yang baru dipilih dari request
        $newSymptomIds = $request->symptoms;

        // Dapatkan aturan (rules) gejala yang saat ini terkait dengan penyakit
        $currentRules = Rule::where('disease_id', $disease->id)->get();
        $currentSymptomIds = $currentRules->pluck('symptom_id')->toArray();

        // 1. Hapus aturan untuk gejala yang TIDAK lagi dipilih
        $symptomsToDetach = array_diff($currentSymptomIds, $newSymptomIds);
        if (!empty($symptomsToDetach)) {
            Rule::where('disease_id', $disease->id)
                ->whereIn('symptom_id', $symptomsToDetach)
                ->delete();
        }

        // 2. Tambahkan aturan untuk gejala yang baru dipilih
        $symptomsToAttach = array_diff($newSymptomIds, $currentSymptomIds);
        foreach ($symptomsToAttach as $symptomId) {
            Rule::create([
                'disease_id' => $disease->id,
                'symptom_id' => $symptomId,
                'cf_value' => 0 // Nilai CF default untuk gejala yang baru ditambahkan
            ]);
        }

        // Catatan: Nilai CF untuk gejala yang sudah ada (yang ada di $currentSymptomIds dan $newSymptomIds)
        // secara implisit dipertahankan karena aturan mereka tidak dihapus atau dimodifikasi di sini.

        return redirect()->route('penyakit.index')->with('success',     'Penyakit berhasil diupdate.');
    }
}
