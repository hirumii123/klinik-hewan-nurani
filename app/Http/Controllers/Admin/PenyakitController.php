<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disease;

class PenyakitController extends Controller
{
    public function index()
    {
        $diseases = \App\Models\Disease::orderBy('id', 'asc')->get();
        return view('admin.penyakit.index', compact('diseases'));
    }
    public function destroy($id)
    {
        $disease = Disease::findOrFail($id);
        $disease->delete();
        return redirect()->route('admin.penyakit.index')->with('success', 'Penyakit berhasil dihapus.');
    }
    public function create()
    {
        return view('admin.penyakit.create');
    }

    public function edit($id)
    {
        $disease = Disease::findOrFail($id);
        return view('admin.penyakit.edit', compact('disease'));
    }
    public function store(Request $request)
    {
        Disease::create($request->only(['code', 'name', 'description', 'solution']));
        return redirect()->route('penyakit.index')->with('success', 'Penyakit berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $disease = Disease::findOrFail($id);
        $disease->update($request->only(['code', 'name', 'description', 'solution']));
        return redirect()->route('penyakit.index')->with('success', 'Penyakit berhasil diupdate.');
    }

}
