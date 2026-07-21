<?php

namespace Database\Seeders;

use App\Models\RatherCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RatherSeeder extends Seeder
{
    /** @var array<string, array{0: string, 1: string}> */
    private const CATEGORIES = [
        'Životinje' => ['razgovarati sa životinjama', 'razumjeti govor ptica'],
        'Svemir' => ['posjetiti Mjesec', 'vidjeti prstenove Saturna'],
        'Supermoći' => ['letjeti iznad oblaka', 'postati nevidljiv na deset minuta'],
        'Hrana' => ['jesti palačinke za doručak', 'praviti najbolju pizzu na svijetu'],
        'Putovanja' => ['putovati vozom kroz planine', 'ploviti brodom do ostrva'],
        'Škola' => ['imati čas u prirodi', 'učiti kroz zabavnu igru'],
        'Sport' => ['postići pobjednički gol', 'osvojiti plivačku utrku'],
        'Muzika' => ['svirati gitaru', 'pjevati na velikoj pozornici'],
        'Priroda' => ['kampovati u šumi', 'gledati zvijezde sa planine'],
        'Bajke' => ['živjeti u dvorcu', 'upoznati prijateljskog zmaja'],
        'Tehnologija' => ['napraviti robota pomagača', 'osmisliti novu videoigru'],
        'Igračke' => ['imati sobu punu kockica', 'dobiti ogromnog plišanog medu'],
        'More' => ['roniti sa delfinima', 'graditi veliki dvorac od pijeska'],
        'Zima' => ['praviti snješka', 'sankati se cijeli dan'],
        'Ljeto' => ['kupati se u moru', 'imati piknik pored rijeke'],
        'Prijateljstvo' => ['organizovati zabavu za prijatelje', 'otići na zajednički izlet'],
        'Mašta' => ['ući u omiljenu knjigu', 'nacrtati svijet koji oživi'],
        'Praznici' => ['ukrašavati cijelu kuću', 'praviti poklone za prijatelje'],
        'Avanture' => ['pronaći skrivenu mapu', 'otkriti tajni prolaz'],
        'Budućnost' => ['voziti leteći automobil', 'živjeti u pametnoj kući'],
    ];

    private const MODIFIERS = [
        ['svaki vikend', 'jednom godišnje'],
        ['sa najboljim prijateljem', 'sa cijelom porodicom'],
        ['tokom sunčanog dana', 'tokom zvjezdane noći'],
        ['bez ikakve pripreme', 'nakon mjesec dana vježbe'],
        ['u svom gradu', 'u dalekoj zemlji'],
        ['uz omiljenu muziku', 'uz smiješan kostim'],
        ['na jedan sat', 'na cijeli dan'],
        ['pred malom ekipom', 'pred punim stadionom'],
        ['kao dio tima', 'kao vođa ekipe'],
        ['odmah danas', 'za vrijeme raspusta'],
    ];

    public function run(): void
    {
        DB::transaction(function () {
            foreach (self::CATEGORIES as $categoryName => [$firstChoice, $secondChoice]) {
                $category = RatherCategory::create([
                    'name' => $categoryName,
                    'slug' => Str::slug($categoryName),
                ]);

                $questions = array_map(
                    fn (array $modifier) => [
                        'option_a' => ucfirst($firstChoice).' '.$modifier[0],
                        'option_b' => ucfirst($secondChoice).' '.$modifier[1],
                    ],
                    self::MODIFIERS,
                );

                $category->questions()->createMany($questions);
            }
        });
    }
}
