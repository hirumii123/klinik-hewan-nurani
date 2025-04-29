<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiseasesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('diseases')->insert([
            ['code' => 'P001', 'name' => 'Chlamydia'],
            ['code' => 'P002', 'name' => 'Scabies'],
            ['code' => 'P003', 'name' => 'Ringworm'],
            ['code' => 'P004', 'name' => 'Cat Flu'],
            ['code' => 'P005', 'name' => 'Kutu/Pinjai'],
            ['code' => 'P006', 'name' => 'Tungau Teinga (Ear Mite)'],
            ['code' => 'P007', 'name' => 'Leptopspirosis'],
            ['code' => 'P008', 'name' => 'Calici Virus'],
            ['code' => 'P009', 'name' => 'FPV (Panlea) Paulekopenia Virus'],
            ['code' => 'P010', 'name' => 'FHV (Feline Herpes Virus)'],
            ['code' => 'P011', 'name' => 'Fraktur'],
            ['code' => 'P012', 'name' => 'Cacingan'],
            ['code' => 'P013', 'name' => 'Abses (bernanah)'],
            ['code' => 'P014', 'name' => 'Jamur'],
            ['code' => 'P015', 'name' => 'Parasit'],
            ['code' => 'P016', 'name' => 'Feline infectious peritonitis (FIP) - Wet'],
            ['code' => 'P017', 'name' => 'Feline infectious peritonitis (FIP) - Dry'],
            ['code' => 'P018', 'name' => 'Intoksikasi (keracunan)'],
            ['code' => 'P019', 'name' => 'FLUTD'],
        ]);
    }
}
