<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const GAMES = [
        'impostor' => 'words',
        'truth_dare' => 'questions',
        'rather' => 'questions',
        'dva_srca' => 'questions',
        'guess_word' => 'words',
    ];

    public function up(): void
    {
        foreach (self::GAMES as $game => $resource) {
            Schema::table("{$game}_{$resource}", function (Blueprint $table) use ($game) {
                $table->dropConstrainedForeignId("{$game}_subcategory_id");
            });

            Schema::dropIfExists("{$game}_subcategories");

            Schema::create("{$game}_subcategories", function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('emoji', 24)->default('✨');
                $table->timestamps();
            });

            Schema::table("{$game}_categories", function (Blueprint $table) use ($game) {
                $table->foreignId("{$game}_subcategory_id")
                    ->nullable()
                    ->after('id')
                    ->constrained("{$game}_subcategories")
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        foreach (array_reverse(self::GAMES, true) as $game => $resource) {
            Schema::table("{$game}_categories", function (Blueprint $table) use ($game) {
                $table->dropConstrainedForeignId("{$game}_subcategory_id");
            });
            Schema::dropIfExists("{$game}_subcategories");

            Schema::create("{$game}_subcategories", function (Blueprint $table) use ($game) {
                $table->engine = 'InnoDB';
                $table->id();
                $table->foreignId("{$game}_category_id")->constrained("{$game}_categories")->cascadeOnDelete();
                $table->string('name');
                $table->string('slug');
                $table->string('emoji', 24)->default('✨');
                $table->timestamps();
                $table->unique(["{$game}_category_id", 'slug']);
            });

            Schema::table("{$game}_{$resource}", function (Blueprint $table) use ($game) {
                $table->foreignId("{$game}_subcategory_id")
                    ->nullable()
                    ->after("{$game}_category_id")
                    ->constrained("{$game}_subcategories")
                    ->nullOnDelete();
            });
        }
    }
};
