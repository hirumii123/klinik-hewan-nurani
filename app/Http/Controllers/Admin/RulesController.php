<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rule;
use App\Models\Disease;
use App\Models\Symptom;

class RulesController extends Controller
{
    public function index()
    {
        $rules = Rule::with(['disease', 'symptom'])->orderBy('id')->get();
        return view('admin.rules.index', compact('rules'));
    }

    public function create()
    {
        // ✅ Ini benar: untuk input <select>
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
            'cf_value' => 'required|numeric|min:0|max:1',
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
            'cf_value' => 'required|numeric|min:0|max:1',
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

