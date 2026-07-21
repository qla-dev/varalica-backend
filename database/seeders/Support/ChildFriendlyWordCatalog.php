<?php

namespace Database\Seeders\Support;

final class ChildFriendlyWordCatalog
{
    private const CATEGORY_HINTS = [
        'Životinje' => 'Živo biće',
        'Hrana' => 'Ukusna hrana',
        'Škola' => 'Školski pojam',
        'Sportovi' => 'Sportska aktivnost',
        'Priroda' => 'Prirodna pojava',
        'Prevoz' => 'Prevozno sredstvo',
        'Zanimanja' => 'Ljudsko zanimanje',
        'Bajke' => 'Čarobna priča',
        'Kuća' => 'Kućni predmet',
        'Muzika' => 'Muzički pojam',
        'Svemir' => 'Svemirski pojam',
        'Tehnologija' => 'Digitalni uređaj',
        'Odjeća' => 'Odjevni predmet',
        'Igračke' => 'Dječija igračka',
        'Vrijeme' => 'Vremenska pojava',
        'Grad' => 'Gradsko mjesto',
        'More' => 'Morski pojam',
        'Farma' => 'Seoski pojam',
        'Praznici' => 'Svečani pojam',
        'Putovanja' => 'Putnički pojam',
    ];

    private const WORD_HINTS = [
        'Lubenica' => 'Ljetno voće',
        'Delfin' => 'Morski sisar',
        'Pingvin' => 'Polarna ptica',
        'Panda' => 'Bambus medvjed',
        'Avion' => 'Zračni prevoz',
        'Bicikl' => 'Dvotočkaš pedale',
        'Vatrogasac' => 'Gasi požare',
        'Doktor' => 'Liječi ljude',
        'Jednorog' => 'Čarobni konj',
        'Gitara' => 'Žičani instrument',
        'Klavir' => 'Instrument tipke',
        'Raketa' => 'Svemirsko vozilo',
        'Astronaut' => 'Svemirski putnik',
        'Telefon' => 'Pametni uređaj',
        'Robot' => 'Mehanički pomagač',
        'Kiša' => 'Vodene kapi',
        'Snijeg' => 'Bijele pahulje',
        'Biblioteka' => 'Kuća knjiga',
        'Svjetionik' => 'Obalno svjetlo',
        'Krava' => 'Daje mlijeko',
        'Pasoš' => 'Putna isprava',
    ];

    /** @return array<string, list<string>> */
    public static function categories(): array
    {
        return [
            'Životinje' => ['Lav', 'Tigar', 'Slon', 'Žirafa', 'Panda', 'Delfin', 'Pingvin', 'Kengur', 'Lisica', 'Sova'],
            'Hrana' => ['Burek', 'Pizza', 'Palačinka', 'Lubenica', 'Jabuka', 'Čokolada', 'Sendvič', 'Krofna', 'Supa', 'Kokice'],
            'Škola' => ['Olovka', 'Gumica', 'Sveska', 'Ruksak', 'Tabla', 'Lenjir', 'Šestar', 'Knjiga', 'Učionica', 'Odmor'],
            'Sportovi' => ['Fudbal', 'Košarka', 'Tenis', 'Plivanje', 'Odbojka', 'Skijanje', 'Biciklizam', 'Gimnastika', 'Rukomet', 'Atletika'],
            'Priroda' => ['Planina', 'Rijeka', 'Jezero', 'Šuma', 'Cvijet', 'Oblak', 'Sunce', 'Mjesec', 'Duga', 'Vodopad'],
            'Prevoz' => ['Automobil', 'Autobus', 'Voz', 'Avion', 'Bicikl', 'Brod', 'Tramvaj', 'Trotinet', 'Helikopter', 'Kamion'],
            'Zanimanja' => ['Doktor', 'Učitelj', 'Vatrogasac', 'Pilot', 'Kuhar', 'Veterinar', 'Arhitekta', 'Poštar', 'Naučnik', 'Glumac'],
            'Bajke' => ['Zmaj', 'Princeza', 'Dvorac', 'Vitez', 'Čarobnjak', 'Vila', 'Kruna', 'Blago', 'Jednorog', 'Čarobni štapić'],
            'Kuća' => ['Krevet', 'Stolica', 'Sto', 'Prozor', 'Vrata', 'Jastuk', 'Lampa', 'Ogledalo', 'Tepih', 'Sat'],
            'Muzika' => ['Gitara', 'Klavir', 'Bubanj', 'Violina', 'Truba', 'Mikrofon', 'Pjesma', 'Koncert', 'Melodija', 'Ples'],
            'Svemir' => ['Planeta', 'Raketa', 'Astronaut', 'Zvijezda', 'Kometa', 'Satelit', 'Galaksija', 'Teleskop', 'Meteor', 'Mjesec'],
            'Tehnologija' => ['Računar', 'Telefon', 'Robot', 'Kamera', 'Tastatura', 'Ekran', 'Slušalice', 'Igrica', 'Internet', 'Punjač'],
            'Odjeća' => ['Majica', 'Jakna', 'Patike', 'Kapa', 'Šal', 'Čarape', 'Haljina', 'Pantalone', 'Rukavice', 'Džemper'],
            'Igračke' => ['Lopta', 'Lutka', 'Kockice', 'Puzzle', 'Frizbi', 'Klikeri', 'Zmaj od papira', 'Plišani medo', 'Autić', 'Bojanka'],
            'Vrijeme' => ['Kiša', 'Snijeg', 'Vjetar', 'Sunce', 'Magla', 'Oluja', 'Mraz', 'Munja', 'Grmljavina', 'Duga'],
            'Grad' => ['Park', 'Biblioteka', 'Muzej', 'Most', 'Trg', 'Kino', 'Pekara', 'Fontana', 'Semafor', 'Stadion'],
            'More' => ['Plaža', 'Školjka', 'Val', 'Svjetionik', 'Jedrilica', 'Ostrvo', 'Morska zvijezda', 'Koral', 'Sidro', 'Pijesak'],
            'Farma' => ['Krava', 'Konj', 'Ovca', 'Kokoš', 'Traktor', 'Štala', 'Sijeno', 'Pšenica', 'Koza', 'Pijetao'],
            'Praznici' => ['Poklon', 'Balon', 'Torta', 'Svjećica', 'Čestitka', 'Ukras', 'Konfete', 'Proslava', 'Iznenađenje', 'Zabava'],
            'Putovanja' => ['Kofer', 'Mapa', 'Pasoš', 'Hotel', 'Kamp', 'Šator', 'Suvenir', 'Izlet', 'Vodič', 'Razglednica'],
        ];
    }

    public static function hint(string $category, string $word): string
    {
        return self::WORD_HINTS[$word] ?? self::CATEGORY_HINTS[$category] ?? 'Poznati pojam';
    }
}
