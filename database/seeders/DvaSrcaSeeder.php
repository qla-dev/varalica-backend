<?php

namespace Database\Seeders;

use App\Models\DvaSrcaCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DvaSrcaSeeder extends Seeder
{
    private const CATEGORIES = [
        'Upoznavanje', 'Prijateljstvo', 'Lijepe uspomene', 'Omiljene stvari', 'Škola',
        'Porodica', 'Hobiji', 'Muzika', 'Filmovi i priče', 'Putovanja',
        'Snove i želje', 'Smijeh', 'Timski rad', 'Dobre osobine', 'Zahvalnost',
        'Avanture', 'Priroda', 'Praznici', 'Budućnost', 'Podrška',
    ];

    private const QUESTIONS = [
        'Koja ti je prva lijepa misao kada pomisliš na temu „%s“?',
        'Koju uspomenu vezanu za temu „%s“ želiš sačuvati zauvijek?',
        'Šta bismo mogli zajedno uraditi u vezi sa temom „%s“?',
        'Šta ti je najvažnije kada razgovaramo o temi „%s“?',
        'Koja sitnica iz teme „%s“ ti uvijek popravi dan?',
        'Šta misliš da nas dvoje najbolje radimo u temi „%s“?',
        'Koju novu stvar bi želio ili željela probati u temi „%s“?',
        'Kako možemo jedno drugom pomoći kada je riječ o temi „%s“?',
        'Koju pohvalu bi dao ili dala drugoj osobi za temu „%s“?',
        'Kako bi izgledao naš savršen dan posvećen temi „%s“?',
    ];

    public function run(): void
    {
        DB::transaction(function () {
            foreach (self::CATEGORIES as $categoryName) {
                $category = DvaSrcaCategory::create([
                    'name' => $categoryName,
                    'slug' => Str::slug($categoryName),
                ]);

                $category->questions()->createMany(array_map(
                    fn (string $template) => ['question' => sprintf($template, $categoryName)],
                    self::QUESTIONS,
                ));
            }
        });
    }
}
