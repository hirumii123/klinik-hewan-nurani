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
        // Query untuk tabel utama, diurutkan berdasarkan kode
        $query = Disease::with('rules.symptom')->orderBy('code', 'asc');

        // Ambil semua daftar penyakit untuk dropdown filter, diurutkan berdasarkan kode
        $allDiseases = Disease::orderBy('code', 'asc')->get(); // Perubahan di sini!

        // Logika filter berdasarkan ID penyakit
        if ($request->has('filter_disease') && $request->filter_disease != '') {
            $diseaseId = $request->filter_disease;
            $query->where('id', $diseaseId); // Filter berdasarkan ID penyakit yang dipilih
        }

        $diseases = $query->get(); // Jalankan query untuk mendapatkan data yang difilter

        // Kirimkan kedua variabel ke view
        return view('admin.penyakit.index', compact('diseases', 'allDiseases'));
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

        // Update rules
        Rule::where('disease_id', $disease->id)->delete();

        foreach ($request->symptoms as $symptomId) {
            Rule::create([
                'disease_id' => $disease->id,
                'symptom_id' => $symptomId,
                'cf_value' => 0
            ]);
        }

        return redirect()->route('penyakit.index')->with('success', 'Penyakit berhasil diupdate.');
    }
}
