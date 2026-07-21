<?php

namespace Tests\Feature;

use App\Models\DvaSrcaQuestion;
use App\Models\GuessWordWord;
use App\Models\ImpostorWord;
use App\Models\RatherQuestion;
use App\Models\TruthDareQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class GameContentSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_every_game_has_twenty_categories_and_two_hundred_items(): void
    {
        $this->seed();

        $expectedCounts = [
            'impostor_categories' => 20,
            'impostor_words' => 200,
            'impostor_subcategories' => 3,
            'truth_dare_categories' => 20,
            'truth_dare_questions' => 200,
            'truth_dare_subcategories' => 3,
            'rather_categories' => 20,
            'rather_questions' => 200,
            'rather_subcategories' => 3,
            'dva_srca_categories' => 20,
            'dva_srca_questions' => 200,
            'dva_srca_subcategories' => 3,
            'guess_word_categories' => 20,
            'guess_word_words' => 200,
            'guess_word_subcategories' => 3,
        ];

        foreach ($expectedCounts as $table => $count) {
            $this->assertDatabaseCount($table, $count);
        }

        foreach (['impostor', 'truth_dare', 'rather', 'dva_srca', 'guess_word'] as $game) {
            $this->assertSame(0, DB::table("{$game}_categories")->where('subtitle', '')->count());
            $this->assertSame(0, DB::table("{$game}_categories")->where('subtitle', 'like', '%na temu%')->count());
        }

        $this->assertSame(100, DB::table('truth_dare_questions')->where('type', 'truth')->count());
        $this->assertSame(100, DB::table('truth_dare_questions')->where('type', 'dare')->count());
    }

    public function test_seeded_items_are_connected_to_their_categories(): void
    {
        $this->seed();

        $this->assertNotNull(ImpostorWord::firstOrFail()->category);
        $this->assertNotNull(ImpostorWord::firstOrFail()->category->subcategory);
        $this->assertNotNull(TruthDareQuestion::firstOrFail()->category);
        $this->assertNotNull(TruthDareQuestion::firstOrFail()->category->subcategory);
        $this->assertNotNull(RatherQuestion::firstOrFail()->category);
        $this->assertNotNull(RatherQuestion::firstOrFail()->category->subcategory);
        $this->assertNotNull(DvaSrcaQuestion::firstOrFail()->category);
        $this->assertNotNull(DvaSrcaQuestion::firstOrFail()->category->subcategory);
        $this->assertNotNull(GuessWordWord::firstOrFail()->category);
        $this->assertNotNull(GuessWordWord::firstOrFail()->category->subcategory);
    }

    public function test_all_impostor_hints_have_exactly_two_words(): void
    {
        $this->seed();

        $hints = ImpostorWord::query()->pluck('hint');
        $this->assertCount(200, $hints);
        foreach ($hints as $hint) {
            $this->assertCount(2, preg_split('/\s+/u', trim($hint)));
        }

        $this->assertDatabaseHas('impostor_words', ['word' => 'Lubenica', 'hint' => 'Ljetno voće']);
    }
}
