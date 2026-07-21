<?php

namespace Database\Seeders;

use Database\Seeders\Support\ChildFriendlyWordCatalog;
use Database\Seeders\Support\CategorySubtitle;
use Database\Seeders\Support\GameCategoryPresentation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GameStructureSeeder extends Seeder
{
    private const GAMES = [
        'impostor' => [
            'words',
            [
                ['Opšte', '🌍', ['Životinje', 'Hrana', 'Škola', 'Sportovi', 'Kuća', 'Odjeća', 'Farma']],
                ['Novo', '✨', ['Priroda', 'Prevoz', 'Zanimanja', 'Svemir', 'Vrijeme', 'Grad', 'Putovanja']],
                ['Gen Z', '⚡', ['Bajke', 'Muzika', 'Tehnologija', 'Igračke', 'More', 'Praznici']],
            ],
        ],
        'truth_dare' => [
            'questions',
            [
                ['Za početak', '🌱', ['Prijateljstvo', 'Škola', 'Porodica', 'Životinje', 'Hrana', 'Dobre navike']],
                ['Društvo', '🤝', ['Sport', 'Muzika', 'Filmovi i crtići', 'Putovanja', 'Hobiji', 'Praznici', 'Timski duh']],
                ['Izazovi', '🎯', ['Priroda', 'Mašta', 'Superheroji', 'Smiješne situacije', 'Talenti', 'Budućnost', 'Avanture']],
            ],
        ],
        'rather' => [
            'questions',
            [
                ['Svakodnevno', '☕', ['Hrana', 'Škola', 'Sport', 'Muzika', 'Tehnologija', 'Igračke', 'Prijateljstvo']],
                ['Avanture', '🗺️', ['Životinje', 'Putovanja', 'Priroda', 'More', 'Zima', 'Ljeto', 'Praznici']],
                ['Nemogući izbori', '🌀', ['Svemir', 'Supermoći', 'Bajke', 'Mašta', 'Avanture', 'Budućnost']],
            ],
        ],
        'dva_srca' => [
            'questions',
            [
                ['Upoznavanje', '👋', ['Upoznavanje', 'Omiljene stvari', 'Škola', 'Hobiji', 'Muzika', 'Filmovi i priče']],
                ['Bliskost', '💞', ['Prijateljstvo', 'Lijepe uspomene', 'Porodica', 'Smijeh', 'Dobre osobine', 'Zahvalnost', 'Podrška']],
                ['Zajedno', '🫶', ['Putovanja', 'Snove i želje', 'Timski rad', 'Avanture', 'Priroda', 'Praznici', 'Budućnost']],
            ],
        ],
        'guess_word' => [
            'words',
            [
                ['Lagano', '🌱', ['Životinje', 'Hrana', 'Škola', 'Kuća', 'Odjeća', 'Igračke', 'Farma']],
                ['Svijet oko nas', '🌎', ['Sportovi', 'Priroda', 'Prevoz', 'Zanimanja', 'Vrijeme', 'Grad', 'Putovanja']],
                ['Zabava', '🎉', ['Bajke', 'Muzika', 'Svemir', 'Tehnologija', 'More', 'Praznici']],
            ],
        ],
    ];

    public function run(): void
    {
        foreach (self::GAMES as $game => [$resource, $groups]) {
            $now = now();
            $subcategoryRows = array_map(fn (array $group) => [
                'name' => $group[0],
                'slug' => Str::slug($group[0]),
                'emoji' => $group[1],
                'created_at' => $now,
                'updated_at' => $now,
            ], $groups);
            DB::table("{$game}_subcategories")->upsert(
                $subcategoryRows,
                ['slug'],
                ['name', 'emoji', 'updated_at'],
            );

            $subcategoryIds = DB::table("{$game}_subcategories")->pluck('id', 'slug');
            $assignment = [];
            foreach ($groups as [$groupName, $emoji, $categoryNames]) {
                foreach ($categoryNames as $categoryName) {
                    $assignment[Str::slug($categoryName)] = $subcategoryIds[Str::slug($groupName)];
                }
            }

            $categories = DB::table("{$game}_categories")->orderBy('id')->get();
            $categoryRows = $categories->map(function ($category, $index) use ($assignment, $game, $subcategoryIds) {
                $row = array_merge((array) $category, GameCategoryPresentation::for($category->name, $index));
                $row["{$game}_subcategory_id"] = $assignment[$category->slug] ?? $subcategoryIds->first();
                $row['subtitle'] = CategorySubtitle::for($category->name);

                return $row;
            })->all();
            DB::table("{$game}_categories")->upsert(
                $categoryRows,
                ['id'],
                ["{$game}_subcategory_id", 'subtitle', 'color', 'emoji'],
            );

            if ($game === 'impostor') {
                $categoryNames = $categories->pluck('name', 'id');
                $wordRows = DB::table("{$game}_{$resource}")->get()->map(function ($word) use ($categoryNames) {
                    $row = (array) $word;
                    $row['hint'] = ChildFriendlyWordCatalog::hint(
                        $categoryNames[$word->impostor_category_id],
                        $word->word,
                    );

                    return $row;
                })->all();
                DB::table("{$game}_{$resource}")->upsert($wordRows, ['id'], ['hint']);
            }
        }
    }
}
