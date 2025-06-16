<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rule;
use App\Models\Disease;
use App\Models\Symptom;

class RulesController extends Controller
{
    public function index(Request $request) // Tambahkan Request sebagai parameter
    {
        $query = Rule::with(['disease', 'symptom'])->orderBy('id', 'asc'); // Mulai query dengan eager loading

        // Logika filter berdasarkan penyakit
        if ($request->has('filter_disease') && $request->filter_disease != '') {
            $diseaseId = $request->filter_disease;
            $query->where('disease_id', $diseaseId);
        }

        $rules = $query->get(); // Jalankan query

        $diseases = Disease::orderBy('code')->get(); // Ambil semua penyakit untuk dropdown filter (diurutkan berdasarkan kode)

        return view('admin.rules.index', compact('rules', 'diseases')); // Kirimkan $diseases ke view
    }

    public function create()
    {
        $diseases = Disease::orderBy('code')->get();
        $symptoms = Symptom::orderBy('code')->get();
        return view('admin.rules.create', compact('diseases', 'symptoms'));
    }

    public function store(Request $request)
    {
        // Validasi dulu kalau mau
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
