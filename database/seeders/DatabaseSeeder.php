<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ImpostorSeeder::class,
            TruthDareSeeder::class,
            RatherSeeder::class,
            DvaSrcaSeeder::class,
            GuessWordSeeder::class,
            GameStructureSeeder::class,
            StarterFreeCategorySeeder::class,
        ]);
    }
}
