<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Symptom;

class KategoriGejalaController extends Controller
{
    public function index()
    {
        $kategori_gejalas = Symptom::select('kategori')->distinct()->orderBy('kategori')->get();
        return view('admin.kategori-gejala.index', compact('kategori_gejalas'));
    }
}
