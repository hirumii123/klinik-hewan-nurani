<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SymptomsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('symptoms')->truncate();

        DB::table('symptoms')->insert([
            ['code' => 'G001', 'name' => 'Mata berair'],
            ['code' => 'G002', 'name' => 'Mata sayu'],
            ['code' => 'G003', 'name' => 'Mata merah'],
            ['code' => 'G004', 'name' => 'Kotoran di sudut mata'],
            ['code' => 'G005', 'name' => 'Bulu mata sering basah'],
            ['code' => 'G006', 'name' => 'Mata bengkak'],
            ['code' => 'G007', 'name' => 'Keluar air mata berlebihan'],
            ['code' => 'G008', 'name' => 'Timbul warna kuning kehijauan pada mata, gusi, bibir, dan kulit'],
            ['code' => 'G009', 'name' => 'Pupil mata tidak fokus'],
            ['code' => 'G010', 'name' => 'Bersin'],
            ['code' => 'G011', 'name' => 'Beleran (ingus)'],
            ['code' => 'G012', 'name' => 'Ingus yang mengental'],
            ['code' => 'G013', 'name' => 'Nafas berat'],
            ['code' => 'G014', 'name' => 'Sesak'],
            ['code' => 'G015', 'name' => 'Batuk'],
            ['code' => 'G016', 'name' => 'Keluar air liur berlebihan'],
            ['code' => 'G017', 'name' => 'Sariawan'],
            ['code' => 'G018', 'name' => 'Anemia terlihat dari gusi dan bibir pucat'],
            ['code' => 'G019', 'name' => 'Telinga seperti berpasir'],
            ['code' => 'G020', 'name' => 'Sering menggelengkan kepala'],
            ['code' => 'G021', 'name' => 'Luka di belakang telinga'],
            ['code' => 'G022', 'name' => 'Telinga memerah'],
            ['code' => 'G023', 'name' => 'Ada cairan di telinga'],
            ['code' => 'G024', 'name' => 'Fokus menggaruk telinga'],
            ['code' => 'G025', 'name' => 'Bulu rontok'],
            ['code' => 'G026', 'name' => 'Kulit bersisik'],
            ['code' => 'G027', 'name' => 'Kulit berkerak'],
            ['code' => 'G028', 'name' => 'Menggaruk badan'],
            ['code' => 'G029', 'name' => 'Luka/bercak bulat merah'],
            ['code' => 'G030', 'name' => 'Luka/bercak bulat cincin'],
            ['code' => 'G031', 'name' => 'Timbul benjolan pada area tertentu'],
            ['code' => 'G032', 'name' => 'Ada nanah'],
            ['code' => 'G033', 'name' => 'Terdapat keropeng'],
            ['code' => 'G034', 'name' => 'Terdapat kutu pada tubuh kucing (terlihat)'],
            ['code' => 'G035', 'name' => 'Kutu banyak'],
            ['code' => 'G036', 'name' => 'Bulu kucing kusam dan berdiri'],
            ['code' => 'G037', 'name' => 'Hilang nafsu makan'],
            ['code' => 'G038', 'name' => 'Nafsu makan banyak tetapi berat badan tidak sesuai standar'],
            ['code' => 'G039', 'name' => 'Diare (termasuk yang disertai cacing)'],
            ['code' => 'G040', 'name' => 'Mual/muntah'],
            ['code' => 'G041', 'name' => 'Pop Belly (perut membesar)'],
            ['code' => 'G042', 'name' => 'Ascites (perut menggelembung berisi cairan)'],
            ['code' => 'G043', 'name' => 'Kesulitan buang air kecil'],
            ['code' => 'G044', 'name' => 'Volume urine sedikit'],
            ['code' => 'G045', 'name' => 'Mengejan saat buang air kecil'],
            ['code' => 'G046', 'name' => 'Urine keluar berwarna merah'],
            ['code' => 'G047', 'name' => 'Dehidrasi'],
            ['code' => 'G048', 'name' => 'Demam'],
            ['code' => 'G049', 'name' => 'Lemas'],
            ['code' => 'G050', 'name' => 'Suhu tubuh turun'],
            ['code' => 'G051', 'name' => 'Kurus (berat badan turun drastis)'],
            ['code' => 'G052', 'name' => 'Kurus (tapi makan banyak)'],
            ['code' => 'G053', 'name' => 'Area fraktur diangkat saat berjalan'],
            ['code' => 'G054', 'name' => 'Pergerakan kucing terlihat kurang nyaman'],
            ['code' => 'G055', 'name' => 'Kucing merasa kesakitan di area tertentu ketika disentuh'],
            ['code' => 'G056', 'name' => 'Tidak ada refleks di area fraktur'],
            ['code' => 'G057', 'name' => 'Sempoyongan'],
            ['code' => 'G058', 'name' => 'Kejang'],
            ['code' => 'G059', 'name' => 'Inkoordinasi (seperti kesurupan/tidak seimbang)'],
            ['code' => 'G060', 'name' => 'Tiba-tiba mati (pagi makan normal, tiba-tiba mati)'],
        ]);
    }
}

