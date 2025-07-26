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

        // Modified to implement logical AND for multiple selected symptoms
        if ($request->has('filter_symptoms') && is_array($request->filter_symptoms) && !empty($request->filter_symptoms)) {
            $symptomIds = $request->filter_symptoms;
            foreach ($symptomIds as $symptomId) {
                // For each selected symptom, add a whereHas clause
                // This ensures the disease must have a rule for ALL selected symptoms
                $query->whereHas('rules', function ($q) use ($symptomId) {
                    $q->where('symptom_id', $symptomId);
                });
            }
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

        $disease->update($request->only(['code', 'name', 'description', 'solution']));

        $newSymptomIds = $request->symptoms;

        $currentRules = Rule::where('disease_id', $disease->id)->get();
        $currentSymptomIds = $currentRules->pluck('symptom_id')->toArray();

        $symptomsToDetach = array_diff($currentSymptomIds, $newSymptomIds);
        if (!empty($symptomsToDetach)) {
            Rule::where('disease_id', $disease->id)
                ->whereIn('symptom_id', $symptomsToDetach)
                ->delete();
        }

        $symptomsToAttach = array_diff($newSymptomIds, $currentSymptomIds);
        foreach ($symptomsToAttach as $symptomId) {
            Rule::create([
                'disease_id' => $disease->id,
                'symptom_id' => $symptomId,
                'cf_value' => 0
            ]);
        }


        return redirect()->route('penyakit.index')->with('success',     'Penyakit berhasil diupdate.');
    }
}
