<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Symptom;

class GejalaController extends Controller
{
    public function index()
    {
        $gejalas = Symptom::orderBy('id', 'asc')->get();
        return view('admin.gejala.index', compact('gejalas'));
    }
    public function destroy($id)
    {
        $gejala = Symptom::findOrFail($id);
        $gejala->delete();
        return redirect()->route('gejala.index')->with('success', 'Gejala berhasil dihapus.');
    }
    public function create()
    {
        $kategoriList = \App\Models\Symptom::select('kategori')->distinct()->pluck('kategori');
        return view('admin.gejala.create', compact('kategoriList'));
    }

    public function edit($id)
    {
        $kategoriList = \App\Models\Symptom::select('kategori')->distinct()->pluck('kategori');
        $gejala = Symptom::findOrFail($id);
        return view('admin.gejala.edit', compact('gejala', 'kategoriList'));
    }
    public function store(Request $request)
    {
        Symptom::create($request->only(['code', 'name', 'kategori']));
        return redirect()->route('gejala.index')->with('success', 'Gejala berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $gejala = Symptom::findOrFail($id);
        $gejala->update($request->only(['code', 'name', 'kategori']));
        return redirect()->route('gejala.index')->with('success', 'Gejala berhasil diupdate.');
    }


}
