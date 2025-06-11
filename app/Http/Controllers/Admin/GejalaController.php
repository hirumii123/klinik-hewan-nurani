<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Symptom;
use App\Models\SymptomCategory;
use Illuminate\Support\Facades\Storage;

class GejalaController extends Controller
{
    public function index()
    {
        $gejalas = Symptom::with('kategori')->orderBy('id', 'asc')->get();
        return view('admin.gejala.index', compact('gejalas'));
    }

    public function create()
    {
        $kategoriList = SymptomCategory::orderBy('name')->get();
        return view('admin.gejala.create', compact('kategoriList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:10|unique:symptoms,code',
            'name' => 'required|string|max:100',
            'kategori_id' => 'required|exists:symptom_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk gambar
            'image_source' => 'nullable|string|max:255', // Validasi untuk sumber gambar
        ]);

        $symptom = Symptom::create([
            'code' => $request->code,
            'name' => $request->name,
            'kategori_id' => $request->kategori_id,
            'image_source' => $request->image_source, // Simpan sumber gambar
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/symptoms', 'public'); // <-- Perubahan di sini!
            $symptom->image = Storage::disk('public')->url($imagePath); // <-- Perubahan di sini!// Simpan path gambar relatif ke storage/app/public
            $symptom->save();
        }

        return redirect()->route('gejala.index')->with('success', 'Gejala berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $gejala = Symptom::findOrFail($id);
        $kategoriList = SymptomCategory::orderBy('name')->get();

        return view('admin.gejala.edit', compact('gejala', 'kategoriList'));
    }

    public function update(Request $request, $id)
    {
        $gejala = Symptom::findOrFail($id);

        $request->validate([
            'code' => 'required|string|max:10|unique:symptoms,code,' . $id,
            'name' => 'required|string|max:100',
            'kategori_id' => 'required|exists:symptom_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_source' => 'nullable|string|max:255',
        ]);

        $gejala->update([
            'code' => $request->code,
            'name' => $request->name,
            'kategori_id' => $request->kategori_id,
            'image_source' => $request->image_source,
        ]);

        if ($request->hasFile('image')) {
            if ($gejala->image && Storage::exists(str_replace('/storage', 'public', $gejala->image))) {
                Storage::delete(str_replace('/storage', 'public', $gejala->image));
            }
            $imagePath = $request->file('image')->store('images/symptoms', 'public');
            $gejala->image = Storage::disk('public')->url($imagePath);
            $gejala->save();
        } elseif ($request->input('clear_image')) {
            if ($gejala->image && Storage::exists(str_replace('/storage', 'public', $gejala->image))) {
                Storage::delete(str_replace('/storage', 'public', $gejala->image));
            }
            $gejala->image = null;
            $gejala->save();
        }

        return redirect()->route('gejala.index')->with('success', 'Gejala berhasil diupdate.');
    }

    public function destroy($id)
    {
        $gejala = Symptom::findOrFail($id);

        if ($gejala->image && Storage::exists(str_replace('/storage', 'public', $gejala->image))) {
            Storage::delete(str_replace('/storage', 'public', $gejala->image));
        }

        $gejala->delete();
        return redirect()->route('gejala.index')->with('success', 'Gejala berhasil dihapus.');
    }
}
