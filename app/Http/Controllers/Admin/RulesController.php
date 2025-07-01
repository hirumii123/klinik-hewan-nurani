<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rule;
use App\Models\Disease;
use App\Models\Symptom;

class RulesController extends Controller
{
    public function index(Request $request)
    {
        // Join with diseases and symptoms tables to order by their codes
        $query = Rule::with(['disease', 'symptom'])
                     ->join('diseases', 'rules.disease_id', '=', 'diseases.id')
                     ->join('symptoms', 'rules.symptom_id', '=', 'symptoms.id') // Added join for symptoms
                     ->select('rules.*') // Select all columns from rules table to avoid conflicts
                     ->orderBy('diseases.code', 'asc')
                     ->orderBy('symptoms.code', 'asc'); // Added secondary order by symptoms.code

        if ($request->has('filter_disease') && $request->filter_disease != '') {
            $diseaseId = $request->filter_disease;
            $query->where('rules.disease_id', $diseaseId);
        }

        if ($request->has('filter_symptom') && $request->filter_symptom != '') {
            $symptomId = $request->filter_symptom;
            $query->where('rules.symptom_id', $symptomId);
        }

        $rules = $query->get();

        $diseases = Disease::orderBy('code')->get();
        $symptoms = Symptom::orderBy('code')->get();

        return view('admin.rules.index', compact('rules', 'diseases', 'symptoms'));
    }

    public function create()
    {
        $diseases = Disease::orderBy('code')->get();
        $symptoms = Symptom::orderBy('code')->get();
        return view('admin.rules.create', compact('diseases', 'symptoms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'symptom_id' => 'required|exists:symptoms,id',
            'disease_id' => 'required|exists:diseases,id',
            'cf_value' => [
                'required',
                'numeric',
                'min:0',
                'max:1',
                function ($attribute, $value, $fail) {
                    if ($value > 1) {
                        $fail('Nilai CF tidak boleh lebih dari 1.');
                    }
                },
            ],
        ]);

        Rule::create($request->only(['symptom_id', 'disease_id', 'cf_value']));

        return redirect()->route('rules.index')->with('success', 'Rule berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $rule = Rule::findOrFail($id);
        $diseases = Disease::orderBy('code')->get();
        $symptoms = Symptom::orderBy('code')->get();
        return view('admin.rules.edit', compact('rule', 'diseases', 'symptoms'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'symptom_id' => 'required|exists:symptoms,id',
            'disease_id' => 'required|exists:diseases,id',
            'cf_value' => [
            'required',
            'numeric',
            'min:0',
            'max:1',
            function ($attribute, $value, $fail) {
                if ($value > 1) {
                    $fail('Nilai CF tidak boleh lebih dari 1.');
                }
            },
        ],
        ]);

        $rule = Rule::findOrFail($id);
        $rule->update($request->only(['symptom_id', 'disease_id', 'cf_value']));

        return redirect()->route('rules.index')->with('success', 'Rule berhasil diupdate.');
    }

    public function destroy($id)
    {
        $rule = Rule::findOrFail($id);
        $rule->delete();
        return redirect()->route('rules.index')->with('success', 'Rule berhasil dihapus.');
    }
}
