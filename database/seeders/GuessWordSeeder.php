<?php

namespace Database\Seeders;

use App\Models\GuessWordCategory;
use Database\Seeders\Support\ChildFriendlyWordCatalog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GuessWordSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            foreach (ChildFriendlyWordCatalog::categories() as $categoryName => $words) {
                $category = GuessWordCategory::create([
                    'name' => $categoryName,
                    'slug' => Str::slug($categoryName),
                ]);

                $category->words()->createMany(array_map(
                    fn (string $word) => ['word' => $word, 'hint' => "Objasni pojam bez izgovaranja riječi {$word}"],
                    $words,
                ));
            }
        });
    }
}
