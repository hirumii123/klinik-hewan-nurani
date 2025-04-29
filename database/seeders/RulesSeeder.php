<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RulesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rules')->truncate();

        $symptoms = DB::table('symptoms')->pluck('id', 'code');
        $diseases = DB::table('diseases')->pluck('id', 'code');

        $rules = [
            // Chlamydia (P001)
            ['G001', 'P001', 1.0],
            ['G002', 'P001', 1.0],
            ['G003', 'P001', 1.0],
            ['G004', 'P001', 1.0],
            ['G005', 'P001', 1.0],

            // Scabies (P002)
            ['G026', 'P002', 0.6],
            ['G027', 'P002', 0.8],
            ['G028', 'P002', 0.8],
            ['G024', 'P002', 0.8],
            ['G025', 'P002', 0.8],
            ['G019', 'P002', 1.0],

            // Ringworm (P003)
            ['G025', 'P003', 1.0],
            ['G029', 'P003', 0.8],
            ['G028', 'P003', 1.0],

            // Cat Flu (P004)
            ['G010', 'P004', 0.8],
            ['G048', 'P004', 0.4],
            ['G037', 'P004', 0.4],
            ['G011', 'P004', 0.8],

            // Kutu/Pinjai (P005)
            ['G025', 'P005', 0.8],
            ['G028', 'P005', 0.6],
            ['G018', 'P005', 0.8],
            ['G034', 'P005', 1.0],

            // Tungau Teinga (Ear Mite) (P006)
            ['G020', 'P006', 0.6],
            ['G021', 'P006', 0.6],
            ['G028', 'P006', 0.8],
            ['G024', 'P006', 1.0],

            // Leptopspirosis (P007)
            ['G048', 'P007', 0.8],
            ['G006', 'P007', 0.4],
            ['G008', 'P007', 1.0],
            ['G037', 'P007', 1.0],

            // Calici Virus (P008)
            ['G037', 'P008', 0.8],
            ['G016', 'P008', 0.8],
            ['G012', 'P008', 0.6],
            ['G021', 'P008', 0.6],
            ['G017', 'P008', 0.8],
            // FPV (Panlea) Paulekopenia Virus (P009)
            ['G037', 'P009', 0.8],
            ['G039', 'P009', 0.6],
            ['G040', 'P009', 0.6],
            ['G048', 'P009', 0.4],
            ['G047', 'P009', 0.4],
            ['G049', 'P009', 0.8],
            // FHV (Feline Herpes Virus) (P010)
            ['G037', 'P010', 0.8],
            ['G048', 'P010', 0.6],
            ['G010', 'P010', 0.6],
            ['G015', 'P010', 0.6],
            ['G001', 'P010', 0.8],
            ['G013', 'P010', 0.6],
            ['G014', 'P010', 0.8],
            // Fraktur (P011)
            ['G054', 'P011', 0.8],
            ['G055', 'P011', 0.8],
            ['G056', 'P011', 1.0],
            // Cacingan (P012)
            ['G036', 'P012', 1.0],
            ['G038', 'P012', 0.8],
            ['G039', 'P012', 0.8],
            ['G041', 'P012', 0.8],
            // Abses (bernanah) (P013)
            ['G032', 'P013', 1.0],
            ['G031', 'P013', 1.0],
            ['G037', 'P013', 0.4],
            ['G048', 'P013', 0.4],
            ['G055', 'P013', 0.6],
            ['G054', 'P013', 0.6],
            // Jamur (P014)
            ['G025', 'P014', 0.8],
            ['G028', 'P014', 0.8],
            ['G030', 'P014', 0.8],
            ['G033', 'P014', 0.8],
            // Parasit (P015)
            ['G049', 'P015', 1.0],
            ['G018', 'P015', 1.0],
            ['G048', 'P015', 0.8],
            ['G037', 'P015', 0.8],
            ['G035', 'P015', 1.0],
            // Feline infectious peritonitis (FIP) - Wet (P016)
            ['G042', 'P016', 1.0],
            ['G051', 'P016', 1.0],
            ['G011', 'P016', 1.0],
            ['G039', 'P016', 0.8],
            // Feline infectious peritonitis (FIP) - Dry (P017)
            ['G057', 'P017', 1.0],
            ['G052', 'P017', 1.0],
            ['G060', 'P017', 1.0],
            // Intoksikasi (keracunan) (P018)
            ['G058', 'P018', 1.0],
            ['G050', 'P018', 1.0],
            ['G040', 'P018', 0.8],
            ['G059', 'P018', 0.8],
            ['G009', 'P018', 1.0],
            // FLUTD (P019)
            ['G043', 'P019', 1.0],
            ['G044', 'P019', 1.0],
            ['G045', 'P019', 1.0],
            ['G046', 'P019', 0.6],
            ['G040', 'P019', 0.4],
            ['G037', 'P019', 0.6],
            ['G049', 'P019', 0.8],
        ];

        foreach ($rules as [$symptomCode, $diseaseCode, $cf]) {
            DB::table('rules')->insert([
                'symptom_id' => $symptoms[$symptomCode],
                'disease_id' => $diseases[$diseaseCode],
                'cf_value'   => $cf,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

