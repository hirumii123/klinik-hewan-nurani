<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\ShortcutRule;
use Illuminate\Http\Request;

class ShortcutRuleController extends Controller
{
    public function index()
    {
        $shortcuts = ShortcutRule::with('disease')->get();
        return view('admin.shortcut-rules.index', compact('shortcuts'));
    }

    public function create()
    {
        $diseases = Disease::orderBy('code')->get();
        $symptoms = Symptom::orderBy('code')->get();
        return view('admin.shortcut-rules.create', compact('diseases', 'symptoms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'disease_code' => 'required|exists:diseases,code',
            'symptom_codes' => 'required|array|min:1',
        ]);

        ShortcutRule::create([
            'disease_code' => $request->disease_code,
            'symptom_codes' => $request->symptom_codes,
        ]);

        return redirect()->route('shortcut-rules.index')->with('success', 'Shortcut berhasil ditambahkan.');
    }
    
    public function edit($id)
    {
        $shortcut = ShortcutRule::findOrFail($id);
        $diseases = Disease::orderBy('code')->get();
        $symptoms = Symptom::orderBy('code')->get();
        return view('admin.shortcut-rules.edit', compact('shortcut', 'diseases', 'symptoms'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'disease_code' => 'required|exists:diseases,code',
            'symptom_codes' => 'required|array|min:1',
        ]);

        $shortcut = ShortcutRule::findOrFail($id);
        $shortcut->update([
            'disease_code' => $request->disease_code,
            'symptom_codes' => $request->symptom_codes,
        ]);

        return redirect()->route('shortcut-rules.index')->with('success', 'Shortcut berhasil diupdate.');
    }

    public function destroy($id)
    {
        $shortcut = ShortcutRule::findOrFail($id);
        $shortcut->delete();

        return redirect()->route('shortcut-rules.index')->with('success', 'Shortcut berhasil dihapus.');
    }

}

