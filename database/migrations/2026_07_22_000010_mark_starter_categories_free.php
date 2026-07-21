<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private const FREE_CATEGORIES = [
        'impostor' => 'zivotinje',
        'truth_dare' => 'prijateljstvo',
        'rather' => 'zivotinje',
        'dva_srca' => 'upoznavanje',
        'guess_word' => 'zivotinje',
    ];

    public function up(): void
    {
        foreach (self::FREE_CATEGORIES as $game => $slug) {
            DB::table("{$game}_categories")
                ->where('slug', $slug)
                ->update(['is_free' => true]);
        }
    }

    public function down(): void
    {
        foreach (self::FREE_CATEGORIES as $game => $slug) {
            DB::table("{$game}_categories")
                ->where('slug', $slug)
                ->update(['is_free' => false]);
        }
    }
};
