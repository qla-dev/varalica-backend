<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StarterFreeCategorySeeder extends Seeder
{
    private const FREE_CATEGORIES = [
        'impostor' => 'zivotinje',
        'truth_dare' => 'prijateljstvo',
        'rather' => 'zivotinje',
        'dva_srca' => 'upoznavanje',
        'guess_word' => 'zivotinje',
    ];

    public function run(): void
    {
        foreach (self::FREE_CATEGORIES as $game => $slug) {
            DB::table("{$game}_categories")
                ->where('slug', $slug)
                ->update(['is_free' => true]);
        }
    }
}
