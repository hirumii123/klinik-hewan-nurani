<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateSymptomKategoriSeeder extends Seeder
{
    public function run(): void
    {
        $map = [
            'Mata' => ['G001', 'G002', 'G003', 'G004', 'G005', 'G006', 'G007', 'G008', 'G009'],
            'Hidung & Pernapasan' => ['G010', 'G011', 'G012', 'G013', 'G014', 'G015'],
            'Mulut' => ['G016', 'G017', 'G018'],
            'Telinga' => ['G019', 'G020', 'G021', 'G022', 'G023', 'G024'],
            'Kulit & Bulu' => ['G025', 'G026', 'G027', 'G028', 'G029', 'G030', 'G031', 'G032', 'G033', 'G034', 'G035', 'G036'],
            'Pencernaan & Urin' => ['G037', 'G038', 'G039', 'G040', 'G041', 'G042', 'G043', 'G044', 'G045', 'G046', 'G047'],
            'Tubuh Umum' => ['G048', 'G049', 'G050', 'G051', 'G052'],
            'Saraf, Tulang, Gerakan' => ['G053', 'G054', 'G055', 'G056', 'G057', 'G058', 'G059'],
            'Gejala Khusus' => ['G060']
        ];

        foreach ($map as $kategori => $codes) {
            DB::table('symptoms')->whereIn('code', $codes)->update(['kategori' => $kategori]);
        }
    }
}
