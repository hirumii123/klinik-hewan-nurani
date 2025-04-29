<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Disease;

class DiseaseController extends Controller
{
    public function index() {
        $diseases = Disease::orderBy('id', 'asc')->get();
        return view('penyakit.index', compact('diseases'));
    }
}
