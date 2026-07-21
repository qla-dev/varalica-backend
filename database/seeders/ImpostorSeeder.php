<?php

namespace Database\Seeders;

use App\Models\ImpostorCategory;
use Database\Seeders\Support\ChildFriendlyWordCatalog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImpostorSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            foreach (ChildFriendlyWordCatalog::categories() as $categoryName => $words) {
                $category = ImpostorCategory::create([
                    'name' => $categoryName,
                    'slug' => Str::slug($categoryName),
                ]);

                $category->words()->createMany(array_map(
                    fn (string $word) => [
                        'word' => $word,
                        'hint' => ChildFriendlyWordCatalog::hint($categoryName, $word),
                    ],
                    $words,
                ));
            }
        });
    }
}
