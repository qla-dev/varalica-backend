<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;

final class StarterFreeContent
{
    public const IMPOSTOR_WORDS = [
        ['Vuk', 'Noćni čopor'], ['Medvjed', 'Šumski div'], ['Zec', 'Brzi skakač'],
        ['Zebra', 'Prugasti konj'], ['Nosorog', 'Rogati div'], ['Nilski konj', 'Riječni kolos'],
        ['Krokodil', 'Močvarni predator'], ['Majmun', 'Nestašni penjač'], ['Gorila', 'Snažni primat'],
        ['Koala', 'Eukaliptus medvjed'], ['Deva', 'Pustinjski putnik'], ['Konj', 'Grivasti trkač'],
        ['Krava', 'Domaće govedo'], ['Ovca', 'Vunasta životinja'], ['Koza', 'Planinska brada'],
        ['Pas', 'Vjerni ljubimac'], ['Mačka', 'Kućni lovac'], ['Hrčak', 'Džepni glodar'],
        ['Kornjača', 'Spori oklop'], ['Zmija', 'Tihi gmizavac'], ['Orao', 'Nebeski lovac'],
        ['Papagaj', 'Šarena pričalica'], ['Flamingo', 'Ružičasta ptica'], ['Paun', 'Raskošni rep'],
        ['Noj', 'Brza ptica'], ['Ajkula', 'Morski predator'], ['Kit', 'Okeanski div'],
        ['Hobotnica', 'Osam krakova'], ['Foka', 'Brkati plivač'], ['Morski konjić', 'Morski jahač'],
        ['Žaba', 'Močvarni skakač'], ['Leptir', 'Krilata ljepotica'], ['Pčela', 'Medena radnica'],
        ['Mrav', 'Sitni radnik'], ['Pauk', 'Mrežni lovac'], ['Puž', 'Spori puzač'],
        ['Jež', 'Bodljikava kugla'], ['Rakun', 'Maskirani lopov'], ['Vjeverica', 'Šumski akrobat'],
        ['Kameleon', 'Šarena kamuflaža'],
    ];

    public const TRUTH_DARE = [
        ['truth', 'Ko je bio tvoj prvi pravi prijatelj i šta vas je povezalo?'],
        ['truth', 'Koju osobinu najviše cijeniš kod najboljeg prijatelja?'],
        ['truth', 'Jesi li ikada prešutio/la nešto prijatelju da ga ne povrijediš?'],
        ['truth', 'Koji trenutak s prijateljima te uvijek nasmije?'],
        ['truth', 'Šta je najljepše što je prijatelj uradio za tebe?'],
        ['truth', 'Koji prijatelj te najbolje razumije bez mnogo objašnjavanja?'],
        ['truth', 'Jesi li se ikada pomirio/la s prijateljem nakon velike svađe?'],
        ['truth', 'Koju avanturu bi najradije ponovio/la sa svojom ekipom?'],
        ['truth', 'Šta nikada ne bi oprostio/la bliskom prijatelju?'],
        ['truth', 'Kome se prvom javiš kada ti treba iskren savjet?'],
        ['truth', 'Koji prijatelj ima najsmješniju naviku?'],
        ['truth', 'Jesi li ikada bio/la ljubomoran/na na prijateljev uspjeh?'],
        ['truth', 'Koja pjesma te podsjeća na tvoju ekipu?'],
        ['truth', 'S kim bi iz ekipe najlakše živio/la kao cimer?'],
        ['truth', 'Ko te je od prijatelja najviše iznenadio svojom dobrotom?'],
        ['truth', 'Koju zajedničku tajnu još uvijek dobro čuvate?'],
        ['truth', 'Šta misliš da tvoji prijatelji najviše vole kod tebe?'],
        ['truth', 'Kada si posljednji put priznao/la prijatelju da si pogriješio/la?'],
        ['truth', 'Koji bi prijatelj najbolje organizovao zajedničko putovanje?'],
        ['truth', 'Šta za tebe razlikuje poznanika od pravog prijatelja?'],
        ['dare', 'Izaberi nekoga iz ekipe i reci mu iskren kompliment.'],
        ['dare', 'Imitiraj smiješnu naviku jednog prijatelja dok ostali pogađaju koga.'],
        ['dare', 'Pošalji prijatelju kojeg dugo nisi čuo/la poruku da misliš na njega.'],
        ['dare', 'Ispričaj najkraću moguću priču o najboljem danu s ekipom.'],
        ['dare', 'Smisli naziv za vašu ekipu i objasni zašto vam pristaje.'],
        ['dare', 'Opiši osobu s lijeve strane koristeći samo tri lijepe riječi.'],
        ['dare', 'Odglumi kako izgleda vaše idealno zajedničko putovanje.'],
        ['dare', 'Otpjevaj dio pjesme koja najbolje opisuje tvoje prijatelje.'],
        ['dare', 'Zahvali jednoj osobi u krugu za nešto konkretno što je uradila.'],
        ['dare', 'Napravi tajno rukovanje s osobom preko puta sebe.'],
        ['dare', 'Ispričaj vic koji bi sigurno nasmijao tvog najboljeg prijatelja.'],
        ['dare', 'Dopusti ekipi da ti smisli prijateljski nadimak do kraja igre.'],
        ['dare', 'Glumi petnaest sekundi da vodiš dodjelu nagrade za najboljeg prijatelja.'],
        ['dare', 'Izaberi dvije osobe koje bi poveo/la na pusto ostrvo i obrazloži izbor.'],
        ['dare', 'Napravi zajedničku fotografsku pozu s osobom desno od sebe.'],
        ['dare', 'Prepričaj jednu uspomenu s ekipom kao sportski komentator.'],
        ['dare', 'Smisli kratku zdravicu posvećenu prijateljstvu.'],
        ['dare', 'Pokaži kako izgleda tvoj ples kada izađeš s najboljom ekipom.'],
        ['dare', 'Nabroji pet stvari koje dobar prijatelj nikada ne radi.'],
        ['dare', 'Izaberi prijatelja i pokušaj ga nasmijati bez dodirivanja.'],
    ];

    public const RATHER_QUESTIONS = [
        ['Imati psa koji može govoriti', 'Imati mačku koja može čitati misli'],
        ['Letjeti na leđima orla', 'Plivati uz delfine'],
        ['Provesti dan kao lav', 'Provesti dan kao vuk'],
        ['Imati slona veličine psa', 'Imati psa veličine slona'],
        ['Živjeti s pingvinima na ledu', 'Živjeti s devama u pustinji'],
        ['Razumjeti samo ptice', 'Razumjeti samo morske životinje'],
        ['Trčati brzo kao gepard', 'Skakati visoko kao kengur'],
        ['Imati pamćenje slona', 'Imati vid orla'],
        ['Biti nježan/na kao panda', 'Biti hrabar/ra kao tigar'],
        ['Čuvati mladunče lava', 'Čuvati mladunče medvjeda'],
        ['Jahati konja kroz planine', 'Voziti se saonicama koje vuku haskiji'],
        ['Imati vrt pun leptira', 'Imati jezero puno šarenih riba'],
        ['Spavati u kućici među majmunima', 'Spavati u podvodnoj sobi među ajkulama'],
        ['Biti veterinar u zoološkom vrtu', 'Biti biolog u morskom rezervatu'],
        ['Vidjeti kita izbliza', 'Vidjeti žirafu u divljini'],
        ['Imati rep poput pauna', 'Mijenjati boju poput kameleona'],
        ['Kretati se sporo kao kornjača', 'Spavati dugo kao medvjed'],
        ['Hraniti rakuna iz ruke', 'Držati ježa u krilu'],
        ['Čuti sovu svake noći', 'Čuti pijetla svakog jutra'],
        ['Imati papagaja koji ponavlja sve', 'Imati vranu koja ti donosi sitnice'],
        ['Roniti s morskim kornjačama', 'Veslati pored krokodila'],
        ['Biti vođa čopora vukova', 'Biti vođa krda slonova'],
        ['Imati farmu s deset koza', 'Imati dvorište s deset pasa'],
        ['Maziti koalu', 'Hraniti pandu bambusom'],
        ['Pratiti tragove lisice u snijegu', 'Posmatrati jelene u šumi'],
        ['Imati krila leptira', 'Imati oklop kornjače'],
        ['Biti malen/a kao mrav', 'Biti visok/a kao žirafa'],
        ['Graditi branu s dabrovima', 'Skupljati orahe s vjevericama'],
        ['Plivati brzo kao ajkula', 'Zaroniti duboko kao kit'],
        ['Imati sedam života kao mačka', 'Uvijek pronaći put kući kao golub'],
        ['Čuvati napuštene pse', 'Pomagati povrijeđenim divljim životinjama'],
        ['Gledati izlazak mladih kornjača iz jaja', 'Gledati prve korake mladunčeta žirafe'],
        ['Živjeti godinu dana bez kućnog ljubimca', 'Svaki dan čistiti za pet ljubimaca'],
        ['Da te prati jato pataka', 'Da te prati porodica zečeva'],
        ['Imati miris psa tragača', 'Imati sluh šišmiša'],
        ['Provesti noć u šumi sa sovama', 'Provesti noć na plaži s rakovima'],
        ['Fotografisati tigra u divljini', 'Snimiti ajkulu pod vodom'],
        ['Udomiti starog psa', 'Udomiti plašljivu mačku'],
        ['Znati gdje se krije svaka životinja', 'Znati šta svaka životinja sanja'],
        ['Zaštititi jednu ugroženu vrstu', 'Očistiti cijelu plažu za morske životinje'],
    ];

    public static function add(): void
    {
        self::insertWords('impostor_categories', 'impostor_words', 'impostor_category_id', true);
        self::insertRows('truth_dare_categories', 'truth_dare_questions', 'truth_dare_category_id', self::TRUTH_DARE,
            fn (array $item) => ['type' => $item[0], 'question' => $item[1]], ['type', 'question']);
        self::insertRows('rather_categories', 'rather_questions', 'rather_category_id', self::RATHER_QUESTIONS,
            fn (array $item) => ['option_a' => $item[0], 'option_b' => $item[1]], ['option_a', 'option_b']);
    }

    public static function remove(): void
    {
        self::deleteWords('impostor_categories', 'impostor_words', 'impostor_category_id');
        self::deleteRows('truth_dare_categories', 'truth_dare_questions', 'truth_dare_category_id', self::TRUTH_DARE,
            fn (array $item) => ['type' => $item[0], 'question' => $item[1]]);
        self::deleteRows('rather_categories', 'rather_questions', 'rather_category_id', self::RATHER_QUESTIONS,
            fn (array $item) => ['option_a' => $item[0], 'option_b' => $item[1]]);
    }

    private static function insertWords(string $categoryTable, string $itemTable, string $foreignKey, bool $impostor): void
    {
        $categoryId = DB::table($categoryTable)->where('slug', 'zivotinje')->value('id');
        if (!$categoryId) return;
        $now = now();
        foreach (self::IMPOSTOR_WORDS as [$word, $hint]) {
            DB::table($itemTable)->insertOrIgnore([
                $foreignKey => $categoryId,
                'word' => $word,
                'hint' => $impostor ? $hint : "Objasni pojam bez izgovaranja riječi {$word}",
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    private static function deleteWords(string $categoryTable, string $itemTable, string $foreignKey): void
    {
        $categoryId = DB::table($categoryTable)->where('slug', 'zivotinje')->value('id');
        if ($categoryId) DB::table($itemTable)->where($foreignKey, $categoryId)
            ->whereIn('word', array_column(self::IMPOSTOR_WORDS, 0))->delete();
    }

    private static function insertRows(string $categoryTable, string $itemTable, string $foreignKey, array $items, callable $map, array $identity): void
    {
        $slug = $categoryTable === 'truth_dare_categories' ? 'prijateljstvo' : 'zivotinje';
        $categoryId = DB::table($categoryTable)->where('slug', $slug)->value('id');
        if (!$categoryId) return;
        $now = now();
        foreach ($items as $item) {
            $row = $map($item);
            $query = DB::table($itemTable)->where($foreignKey, $categoryId);
            foreach ($identity as $column) $query->where($column, $row[$column]);
            if (!$query->exists()) DB::table($itemTable)->insert([
                $foreignKey => $categoryId, ...$row, 'created_at' => $now, 'updated_at' => $now,
            ]);
        }
    }

    private static function deleteRows(string $categoryTable, string $itemTable, string $foreignKey, array $items, callable $map): void
    {
        $slug = $categoryTable === 'truth_dare_categories' ? 'prijateljstvo' : 'zivotinje';
        $categoryId = DB::table($categoryTable)->where('slug', $slug)->value('id');
        if (!$categoryId) return;
        foreach ($items as $item) {
            $row = $map($item);
            $query = DB::table($itemTable)->where($foreignKey, $categoryId);
            foreach ($row as $column => $value) $query->where($column, $value);
            $query->delete();
        }
    }
}
