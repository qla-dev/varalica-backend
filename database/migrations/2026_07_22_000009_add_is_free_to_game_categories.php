<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const GAMES = ['impostor', 'truth_dare', 'rather', 'dva_srca', 'guess_word'];

    public function up(): void
    {
        foreach (self::GAMES as $game) {
            Schema::table("{$game}_categories", function (Blueprint $table) {
                $table->boolean('is_free')->default(false)->index()->after('subtitle');
            });
        }
    }

    public function down(): void
    {
        foreach (self::GAMES as $game) {
            Schema::table("{$game}_categories", function (Blueprint $table) {
                $table->dropColumn('is_free');
            });
        }
    }
};
