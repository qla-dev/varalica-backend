<?php

namespace Database\Seeders;

use App\Models\TruthDareCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TruthDareSeeder extends Seeder
{
    private const CATEGORIES = [
        'Prijateljstvo', 'Škola', 'Porodica', 'Životinje', 'Hrana',
        'Sport', 'Muzika', 'Filmovi i crtići', 'Putovanja', 'Priroda',
        'Mašta', 'Superheroji', 'Smiješne situacije', 'Hobiji', 'Praznici',
        'Dobre navike', 'Timski duh', 'Talenti', 'Budućnost', 'Avanture',
    ];

    private const TRUTHS = [
        'Šta ti je najdraže u temi „%s“?',
        'Koji ti je najljepši trenutak povezan sa temom „%s“?',
        'Šta bi volio ili voljela naučiti o temi „%s“?',
        'Koga bi poveo ili povela u avanturu vezanu za „%s“?',
        'Šta te uvijek nasmije kada pomisliš na „%s“?',
    ];

    private const DARES = [
        'U deset sekundi navedi tri stvari povezane sa temom „%s“.',
        'Odglumi nešto iz teme „%s“ bez ijedne riječi.',
        'Nacrtaj prstom u zraku nešto povezano sa temom „%s“.',
        'Smisli kratku veselu pjesmicu o temi „%s“.',
        'Ispričaj jednu lijepu rečenicu o temi „%s“ smiješnim glasom.',
    ];

    public function run(): void
    {
        DB::transaction(function () {
            foreach (self::CATEGORIES as $categoryName) {
                $category = TruthDareCategory::create([
                    'name' => $categoryName,
                    'slug' => Str::slug($categoryName),
                ]);

                $questions = [];
                foreach (self::TRUTHS as $template) {
                    $questions[] = ['type' => 'truth', 'question' => sprintf($template, $categoryName)];
                }
                foreach (self::DARES as $template) {
                    $questions[] = ['type' => 'dare', 'question' => sprintf($template, $categoryName)];
                }

                $category->questions()->createMany($questions);
            }
        });
    }
}
