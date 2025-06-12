<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // SymptomsSeeder::class,
            // DiseasesSeeder::class,
            RulesSeeder::class,
            UserSeeder::class,
            SymptomsSeeder::class,
            DiseasesSeeder::class,
            SymptomCategorySeeder::class,
            UpdateSymptomCategorySeeder::class,
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
