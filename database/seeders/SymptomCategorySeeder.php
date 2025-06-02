<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Symptom;
use App\Models\SymptomCategory;

class SymptomCategorySeeder extends Seeder
{
    public function run()
    {
        $kategoriList = [
            'Gejala Khusus',
            'Hidung & Pernapasan',
            'Kulit & Bulu',
            'Mata',
            'Mulut',
            'Pencernaan & Urin',
            'Saraf, Tulang, Gerakan',
            'Telinga',
            'Tubuh Umum',
        ];

        foreach ($kategoriList as $kategori) {
            SymptomCategory::firstOrCreate(['name' => $kategori]);
        }

        // Setelah insert kategori, update relasi kategori_id pada symptoms
        foreach (Symptom::whereNotNull('kategori')->get() as $symptom) {
            $cat = SymptomCategory::where('name', $symptom->kategori)->first();
            if ($cat) {
                $symptom->kategori_id = $cat->id;
                $symptom->save();
            }
        }
    }
}

