<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;

final class StarterFreeContent
{
    public const IMPOSTOR_WORDS = [
        ['Pećina', 'Podzemna šupljina'], ['Vulkan', 'Vatrena planina'],
        ['Kanjon', 'Duboka dolina'], ['Livada', 'Travnata ravnica'],
        ['Pustinja', 'Pješčana ravnica'], ['Ostrvo', 'Okruženo morem'],
        ['Glečer', 'Ledena rijeka'], ['Izvor', 'Početak rijeke'],
        ['Potok', 'Mala rijeka'], ['Brdo', 'Niska uzvisina'],
        ['Dolina', 'Nisko zemljište'], ['Stijena', 'Tvrdi kamen'],
        ['Litica', 'Strma stijena'], ['Močvara', 'Vlažno zemljište'],
        ['Prašuma', 'Gusta šuma'], ['Savana', 'Tropska ravnica'],
        ['Gejzir', 'Vrući mlaz'], ['Lavina', 'Snježna bujica'],
        ['Talasi', 'Morski pokreti'], ['Pješčana dina', 'Pješčano brdo'],
        ['Koraljni greben', 'Podvodni ekosistem'], ['Sjeverna svjetlost', 'Polarna svjetlost'],
        ['Horizont', 'Daleka granica'], ['Rosa', 'Jutarnje kapljice'],
        ['Inje', 'Ledeni kristali'], ['Grad', 'Ledene kuglice'],
        ['Munja', 'Električni bljesak'], ['Grmljavina', 'Olujni zvuk'],
        ['Pahulja', 'Snježni kristal'], ['Ledenica', 'Viseći led'],
        ['Mahovina', 'Zeleni pokrivač'], ['Paprat', 'Šumska biljka'],
        ['Lopoč', 'Vodeni cvijet'], ['Trska', 'Močvarna biljka'],
        ['Bor', 'Zimzeleno drvo'], ['Hrast', 'Snažno drvo'],
        ['Kesten', 'Šumski plod'], ['Žir', 'Hrastov plod'],
        ['Kamenčić', 'Mali kamen'], ['Blato', 'Mokra zemlja'],
    ];

    public const IMPOSTOR_SCHOOL_WORDS = [
        ['Profesor', 'Školski nastavnik'], ['Učenik', 'Mladi polaznik'],
        ['Dnevnik', 'Evidencija ocjena'], ['Zadaća', 'Kućni zadatak'],
        ['Test', 'Provjera znanja'], ['Ocjena', 'Školski rezultat'],
        ['Klupa', 'Školski namještaj'], ['Kreda', 'Bijeli štapić'],
        ['Marker', 'Šarena olovka'], ['Pernica', 'Čuva pribor'],
        ['Udžbenik', 'Školska knjiga'], ['Atlas', 'Zbirka karata'],
        ['Globus', 'Model Zemlje'], ['Kalkulator', 'Računski uređaj'],
        ['Mikroskop', 'Uvećava predmete'], ['Laboratorija', 'Naučna učionica'],
        ['Biblioteka', 'Pozajmljuje knjige'], ['Hodnik', 'Školski prolaz'],
        ['Zvono', 'Označava odmor'], ['Direktor', 'Vodi školu'],
        ['Pedagog', 'Pomaže učenicima'], ['Sekretar', 'Školska administracija'],
        ['Čuvar', 'Školska sigurnost'], ['Kantina', 'Školska kuhinja'],
        ['Uniforma', 'Jednaka odjeća'], ['Ekskurzija', 'Školsko putovanje'],
        ['Matura', 'Završna proslava'], ['Svjedočanstvo', 'Pregled ocjena'],
        ['Diploma', 'Potvrda uspjeha'], ['Raspored', 'Plan časova'],
        ['Predmet', 'Oblast učenja'], ['Čas', 'Vrijeme nastave'],
        ['Diktat', 'Pisana vježba'], ['Sastav', 'Pismeni rad'],
        ['Lektira', 'Obavezna knjiga'], ['Geometrija', 'Nauka oblika'],
        ['Historija', 'Prošli događaji'], ['Geografija', 'Proučava Zemlju'],
        ['Biologija', 'Proučava život'], ['Hemija', 'Proučava materiju'],
    ];

    public const TRUTH_DARE = [
        ['truth', 'Koji ti se najsmješniji peh dogodio pred drugim ljudima?'],
        ['truth', 'Jesi li se ikada smijao/la u trenutku kada nije trebalo?'],
        ['truth', 'Koju si riječ najduže pogrešno izgovarao/la?'],
        ['truth', 'Koji je najčudniji san kojeg se još sjećaš?'],
        ['truth', 'Jesi li ikada mahnuo/la osobi koja uopšte nije mahala tebi?'],
        ['truth', 'Koji tvoj plesni pokret uvijek nasmije ekipu?'],
        ['truth', 'Koji si izgovor smislio/la, a niko ti nije povjerovao?'],
        ['truth', 'Šta si najčudnije uradio/la kada si mislio/la da te niko ne gleda?'],
        ['truth', 'Koji te video ili šala može nasmijati svaki put?'],
        ['truth', 'Jesi li ikada ušao/la u pogrešnu prostoriju kao da znaš gdje ideš?'],
        ['truth', 'Koji ti je najsmješniji nadimak neko dao?'],
        ['truth', 'Koja je najčudnija kombinacija hrane koju voliš?'],
        ['truth', 'Jesi li ikada poslao/la poruku pogrešnoj osobi?'],
        ['truth', 'Koju bi svoju neugodnu situaciju danas rado ponovio/la zbog smijeha?'],
        ['truth', 'Koji član ekipe ima najsmješniji izraz lica?'],
        ['truth', 'Kada si se posljednji put smijao/la toliko da nisi mogao/la govoriti?'],
        ['truth', 'Koju pjesmu uvijek pjevaš pogrešnim riječima?'],
        ['truth', 'Koja ti je najčudnija navika kada si sam/a?'],
        ['truth', 'Jesi li ikada pokušao/la izgledati kul pa se osramotio/la?'],
        ['truth', 'Koja porodična anegdota o tebi se najčešće prepričava?'],
        ['dare', 'Odglumi kako izgleda kada se oklizneš, ali pokušavaš ostati ozbiljan/na.'],
        ['dare', 'Ispričaj običnu rečenicu kao pretjerano dramatičan filmski negativac.'],
        ['dare', 'Hodaj deset sekundi kao pingvin koji kasni na autobus.'],
        ['dare', 'Napravi tri najsmješnija izraza lica bez ponavljanja.'],
        ['dare', 'Imitiraj alarm za buđenje koji postaje sve nervozniji.'],
        ['dare', 'Pokušaj prodati običnu čarapu kao luksuzni proizvod.'],
        ['dare', 'Otpjevaj svoje ime kao refren velike pop pjesme.'],
        ['dare', 'Odglumi usporeni snimak hvatanja zamišljene lopte.'],
        ['dare', 'Govori sljedećih trideset sekundi kao voditelj vremenske prognoze.'],
        ['dare', 'Izmisli smiješan pozdrav i nauči osobu do sebe da ga ponovi.'],
        ['dare', 'Pokaži kako bi robot pokušao plesati kolo.'],
        ['dare', 'Ispričaj vic bez smijanja dok te ostali pokušavaju nasmijati.'],
        ['dare', 'Odglumi mačku koja je upravo ugledala krastavac.'],
        ['dare', 'Napravi reklamu za nevidljivi kišobran u deset sekundi.'],
        ['dare', 'Pročitaj posljednju rečenicu koju si rekao/la glasom crtanog junaka.'],
        ['dare', 'Zamisli da je pod lava i pređi na drugu stranu kruga.'],
        ['dare', 'Smisli kratku pjesmicu o osobi s lijeve strane.'],
        ['dare', 'Glumi sportskog komentatora dok neko iz ekipe ustaje sa stolice.'],
        ['dare', 'Pokušaj objasniti šta je kašika kao da je vanzemaljski predmet.'],
        ['dare', 'Nasmij osobu preko puta koristeći samo jedan zvuk.'],
    ];

    public const RATHER_QUESTIONS = [
        ['Putovati na Mjesec', 'Putovati na Mars'],
        ['Vidjeti prstenove Saturna izbliza', 'Prošetati površinom Venere'],
        ['Biti astronaut', 'Biti astronom'],
        ['Živjeti u svemirskoj stanici', 'Živjeti u bazi na Mjesecu'],
        ['Otkriti novu planetu', 'Otkriti novu galaksiju'],
        ['Voziti svemirski brod', 'Upravljati robotom na Marsu'],
        ['Imati teleskop koji vidi prošlost', 'Imati raketu koja leti brže od svjetlosti'],
        ['Sresti prijateljske vanzemaljce', 'Pronaći tragove drevnog života'],
        ['Gledati pomračenje Sunca iz svemira', 'Gledati polarnu svjetlost s Mjeseca'],
        ['Lebdjeti bez gravitacije cijeli dan', 'Skakati šest puta više na Mjesecu'],
        ['Ponijeti psa u svemir', 'Ponijeti mačku u svemir'],
        ['Nazvati novu zvijezdu', 'Nazvati novi mjesec'],
        ['Spavati pored prozora svemirske stanice', 'Kampovati pod zvijezdama na Marsu'],
        ['Fotografisati crnu rupu', 'Snimiti eksploziju supernove'],
        ['Imati odijelo astronauta', 'Imati vlastiti mali satelit'],
        ['Putovati kroz asteroidni pojas', 'Proletjeti kroz rep komete'],
        ['Znati odgovor kako je svemir nastao', 'Znati postoji li život izvan Zemlje'],
        ['Razgovarati s astronautom', 'Razgovarati s naučnikom koji proučava svemir'],
        ['Posjetiti najveću planetu', 'Posjetiti najmanju planetu'],
        ['Vidjeti Zemlju s Mjeseca', 'Vidjeti Sunce s Merkura'],
        ['Imati sobu poput svemirskog broda', 'Imati dvorište poput druge planete'],
        ['Nositi svemirsku hranu sedmicu', 'Spavati u vreći pričvršćenoj za zid sedmicu'],
        ['Čuti zvukove svemira', 'Vidjeti nevidljive boje zvijezda'],
        ['Biti prvi čovjek na novoj planeti', 'Biti kapetan prve svemirske kolonije'],
        ['Istraživati ledeni mjesec', 'Istraživati vrelu planetu'],
        ['Pronaći vodu na Marsu', 'Pronaći biljku na drugoj planeti'],
        ['Imati robota astronauta', 'Imati vanzemaljskog ljubimca'],
        ['Proslaviti rođendan u svemiru', 'Dočekati Novu godinu na Mjesecu'],
        ['Gledati hiljadu zvijezda padalica', 'Vidjeti jednu kometu iz velike blizine'],
        ['Putovati sto godina u budućnost', 'Putovati do najbliže zvijezde'],
        ['Graditi raketu', 'Dizajnirati svemirsko odijelo'],
        ['Letjeti pored Jupitera', 'Sletjeti na jedan Saturnov mjesec'],
        ['Jesti sladoled bez gravitacije', 'Piti sok na Mjesecu'],
        ['Imati kartu cijele galaksije', 'Imati uzorak kamena s Marsa'],
        ['Probuditi se na svemirskom brodu', 'Probuditi se u opservatoriji'],
        ['Posmatrati zvijezde svake noći', 'Jednom vidjeti Zemlju iz orbite'],
        ['Otkriti planetu nalik Zemlji', 'Otkriti potpuno novu vrstu zvijezde'],
        ['Biti poznat/a po svemirskom otkriću', 'Tajno istraživati nepoznatu planetu'],
        ['Imati gravitaciju samo kada želiš', 'Moći disati na svakoj planeti'],
        ['Vratiti se kući nakon godine u svemiru', 'Nastaviti istraživanje još pet godina'],
    ];

    public static function add(): void
    {
        self::insertWords('impostor_categories', 'impostor_words', 'impostor_category_id', 'priroda', self::IMPOSTOR_WORDS);
        self::insertWords('impostor_categories', 'impostor_words', 'impostor_category_id', 'skola', self::IMPOSTOR_SCHOOL_WORDS);
        self::insertRows('truth_dare_categories', 'truth_dare_questions', 'truth_dare_category_id', self::TRUTH_DARE,
            fn (array $item) => ['type' => $item[0], 'question' => $item[1]], ['type', 'question']);
        self::insertRows('rather_categories', 'rather_questions', 'rather_category_id', self::RATHER_QUESTIONS,
            fn (array $item) => ['option_a' => $item[0], 'option_b' => $item[1]], ['option_a', 'option_b']);
    }

    public static function remove(): void
    {
        self::deleteWords('impostor_categories', 'impostor_words', 'impostor_category_id', 'priroda', self::IMPOSTOR_WORDS);
        self::deleteWords('impostor_categories', 'impostor_words', 'impostor_category_id', 'skola', self::IMPOSTOR_SCHOOL_WORDS);
        self::deleteRows('truth_dare_categories', 'truth_dare_questions', 'truth_dare_category_id', self::TRUTH_DARE,
            fn (array $item) => ['type' => $item[0], 'question' => $item[1]]);
        self::deleteRows('rather_categories', 'rather_questions', 'rather_category_id', self::RATHER_QUESTIONS,
            fn (array $item) => ['option_a' => $item[0], 'option_b' => $item[1]]);
    }

    private static function insertWords(string $categoryTable, string $itemTable, string $foreignKey, string $slug, array $items): void
    {
        $categoryId = DB::table($categoryTable)->where('slug', $slug)->value('id');
        if (!$categoryId) return;
        $now = now();
        foreach ($items as [$word, $hint]) {
            DB::table($itemTable)->insertOrIgnore([
                $foreignKey => $categoryId,
                'word' => $word,
                'hint' => $hint,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    private static function deleteWords(string $categoryTable, string $itemTable, string $foreignKey, string $slug, array $items): void
    {
        $categoryId = DB::table($categoryTable)->where('slug', $slug)->value('id');
        if ($categoryId) DB::table($itemTable)->where($foreignKey, $categoryId)
            ->whereIn('word', array_column($items, 0))->delete();
    }

    private static function insertRows(string $categoryTable, string $itemTable, string $foreignKey, array $items, callable $map, array $identity): void
    {
        $slug = $categoryTable === 'truth_dare_categories' ? 'smijesne-situacije' : 'svemir';
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
        $slug = $categoryTable === 'truth_dare_categories' ? 'smijesne-situacije' : 'svemir';
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
