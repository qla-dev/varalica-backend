<?php

namespace Database\Seeders;

use App\Support\StarterFreeContent;
use Illuminate\Database\Seeder;

class StarterFreeCategorySeeder extends Seeder
{
    public function run(): void
    {
        StarterFreeContent::add();
    }
}
