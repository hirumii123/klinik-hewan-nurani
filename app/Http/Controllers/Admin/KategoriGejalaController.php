<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Symptom;

class KategoriGejalaController extends Controller
{
    public function index()
    {
        // Ambil kategori unik
        $kategori_gejalas = Symptom::select('kategori')->distinct()->orderBy('kategori')->get();
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

        // Cek apakah kategori sudah ada
        $exists = Symptom::where('kategori', $request->kategori)->exists();
        if ($exists) {
            return redirect()->route('kategori-gejala.index')
                ->with('warning', 'Kategori sudah ada.');
        }

        // Simpan dengan dummy gejala agar kategori masuk
        Symptom::create([
            'code' => 'TEMP', // atau generate kode dummy
            'name' => 'Temporary Placeholder',
            'kategori' => $request->kategori
        ]);

        return redirect()->route('kategori-gejala.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($kategori)
    {
        return view('admin.kategori-gejala.edit', compact('kategori'));
    }

    public function update(Request $request, $kategori)
    {
        $request->validate([
            'kategori_baru' => 'required|string|max:100'
        ]);

        // Update semua symptom yang pakai kategori lama
        Symptom::where('kategori', $kategori)->update(['kategori' => $request->kategori_baru]);

        return redirect()->route('kategori-gejala.index')->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy($kategori)
    {
        // Hapus kategori dari semua symptom (bisa jadi null atau dihapus gejalanya sekalian)
        Symptom::where('kategori', $kategori)->update(['kategori' => null]);

        return redirect()->route('kategori-gejala.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
?>
