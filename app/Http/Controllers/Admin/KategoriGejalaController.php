<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Symptom;
use App\Models\SymptomCategory;

class KategoriGejalaController extends Controller
{
    public function index()
    {
        $kategori_gejalas = SymptomCategory::orderBy('name')->get();
        return view('admin.kategori-gejala.index', compact('kategori_gejalas'));
    }

    public function create()
    {
        return view('admin.kategori-gejala.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:100'
        ]);

        $exists = SymptomCategory::where('name', $request->kategori)->exists();
        if ($exists) {
            return redirect()->route('kategori-gejala.index')
                ->with('warning', 'Kategori sudah ada.');
        }

        SymptomCategory::create([
            'name' => $request->kategori
        ]);

        return redirect()->route('kategori-gejala.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = SymptomCategory::findOrFail($id);
        return view('admin.kategori-gejala.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_baru' => 'required|string|max:100'
        ]);

        $kategori = SymptomCategory::findOrFail($id);
        $kategori->update(['name' => $request->kategori_baru]);

        return redirect()->route('kategori-gejala.index')->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy($id)
    {
        Symptom::where('kategori_id', $id)->update(['kategori_id' => null]);

        SymptomCategory::destroy($id);

        return redirect()->route('kategori-gejala.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
?>
