<?php

namespace Database\Seeders\Support;

use InvalidArgumentException;

final class CategorySubtitle
{
    private const SUBTITLES = [
        'Avanture' => 'Mape i skrivena blaga.',
        'Bajke' => 'Zmajevi i čarobni junaci.',
        'Budućnost' => 'Svijet koji tek dolazi.',
        'Dobre navike' => 'Male odluke za bolji dan.',
        'Dobre osobine' => 'Vrline koje krase ljude.',
        'Farma' => 'Život i poslovi na selu.',
        'Filmovi i crtići' => 'Junaci s malih ekrana.',
        'Filmovi i priče' => 'Priče koje rado gledamo.',
        'Grad' => 'Poznata mjesta iz grada.',
        'Hobiji' => 'Zabava u slobodno vrijeme.',
        'Hrana' => 'Ukusni zalogaji i jela.',
        'Igračke' => 'Stvari stvorene za igru.',
        'Kuća' => 'Poznati predmeti iz doma.',
        'Lijepe uspomene' => 'Trenuci vrijedni pamćenja.',
        'Ljeto' => 'Sunce, kupanje i raspust.',
        'Mašta' => 'Svjetovi bez granica.',
        'More' => 'Valovi i morska otkrića.',
        'Muzika' => 'Ritam, pjesme i instrumenti.',
        'Odjeća' => 'Od glave do pete.',
        'Omiljene stvari' => 'Sitnice koje volimo.',
        'Podrška' => 'Riječi koje daju snagu.',
        'Porodica' => 'Ljubav koja nas povezuje.',
        'Praznici' => 'Ukrasi, pokloni i slavlje.',
        'Prevoz' => 'Vozila za blizu i daleko.',
        'Prijateljstvo' => 'Povjerenje i zajednički smijeh.',
        'Priroda' => 'Planine, rijeke i šume.',
        'Putovanja' => 'Nova mjesta i uspomene.',
        'Smijeh' => 'Trenuci puni osmijeha.',
        'Smiješne situacije' => 'Nezgode koje nas nasmiju.',
        'Snove i želje' => 'Ono što želimo ostvariti.',
        'Sport' => 'Pokret, ekipa i pobjeda.',
        'Sportovi' => 'Igre, tereni i takmičenja.',
        'Superheroji' => 'Junaci koji spašavaju dan.',
        'Supermoći' => 'Nevjerovatne moći iz mašte.',
        'Svemir' => 'Planete i daleke galaksije.',
        'Talenti' => 'Vještine koje nas izdvajaju.',
        'Tehnologija' => 'Uređaji naše svakodnevice.',
        'Timski duh' => 'Zajedništvo vodi do pobjede.',
        'Timski rad' => 'Zajedno možemo mnogo više.',
        'Upoznavanje' => 'Pitanja koja otkrivaju ko smo.',
        'Vrijeme' => 'Kiša, sunce i oblaci.',
        'Zahvalnost' => 'Male stvari koje cijenimo.',
        'Zanimanja' => 'Poslovi koje ljudi rade.',
        'Zima' => 'Snijeg, sankanje i hladnoća.',
        'Škola' => 'Učionice, knjige i znanje.',
        'Životinje' => 'Lavovi, pande i delfini.',
    ];

    public static function for(string $category): string
    {
        return self::SUBTITLES[$category]
            ?? throw new InvalidArgumentException("Nedostaje subtitle za kategoriju: {$category}");
    }
}
