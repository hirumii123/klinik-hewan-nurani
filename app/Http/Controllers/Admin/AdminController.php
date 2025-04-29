<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Symptom;
use App\Models\Disease;
use App\Models\Rule;
use App\Models\ShortcutRule;

class AdminController extends Controller
{
    public function index()
    {
        $jumlahGejala = Symptom::count();
        $jumlahPenyakit = Disease::count();
        $jumlahRule = Rule::count();
        $jumlahShortcut = ShortcutRule::count();

        return view('admin.index', compact(
            'jumlahGejala',
            'jumlahPenyakit',
            'jumlahRule',
            'jumlahShortcut'
        ));
    }
}

