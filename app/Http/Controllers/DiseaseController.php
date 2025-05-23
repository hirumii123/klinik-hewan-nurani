<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Disease;

class DiseaseController extends Controller
{
    public function index() {
        $diseases = Disease::with('rules.symptom')->orderBy('id', 'asc')->get();
        return view('penyakit.index', compact('diseases'));
    }

    public function info()
    {
        $diseases = Disease::orderBy('id', 'asc')->get();
        return view('info-diagnosa.index', compact('diseases'));
    }

}
