<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Symptom;
use App\Models\SymptomCategory;

class GejalaController extends Controller
{
    public function index()
    {
        $gejalas = Symptom::with('kategori')->orderBy('id', 'asc')->get();
        return view('admin.gejala.index', compact('gejalas'));
    }

    public function create()
    {
        $kategoriList = \App\Models\SymptomCategory::orderBy('name')->get();
        return view('admin.gejala.create', compact('kategoriList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:10',
            'name' => 'required|string|max:100',
            'kategori_id' => 'required|exists:symptom_categories,id',
        ]);

        Symptom::create([
            'code' => $request->code,
            'name' => $request->name,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('gejala.index')->with('success', 'Gejala berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $gejala = Symptom::findOrFail($id);
        $kategoriList = \App\Models\SymptomCategory::orderBy('name')->get();

        return view('admin.gejala.edit', compact('gejala', 'kategoriList'));
    }

    public function update(Request $request, $id)
    {
        $gejala = Symptom::findOrFail($id);
        $gejala->update($request->only(['code', 'name', 'kategori_id']));
        return redirect()->route('gejala.index')->with('success', 'Gejala berhasil diupdate.');
    }

    public function destroy($id)
    {
        $gejala = Symptom::findOrFail($id);
        $gejala->delete();
        return redirect()->route('gejala.index')->with('success', 'Gejala berhasil dihapus.');
    }
}
