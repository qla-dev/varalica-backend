<?php

namespace Database\Seeders;

use App\Support\StarterFreeContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StarterFreeCategorySeeder extends Seeder
{
    private const FREE_CATEGORIES = [
        'impostor' => 'priroda',
        'truth_dare' => 'smijesne-situacije',
        'rather' => 'svemir',
        'dva_srca' => 'upoznavanje',
        'guess_word' => 'zivotinje',
    ];

    public function run(): void
    {
        foreach (array_keys(self::FREE_CATEGORIES) as $game) {
            DB::table("{$game}_categories")->update(['is_free' => false]);
        }

        foreach (self::FREE_CATEGORIES as $game => $slug) {
            DB::table("{$game}_categories")
                ->where('slug', $slug)
                ->update(['is_free' => true]);
        }

        StarterFreeContent::add();
    }
}
