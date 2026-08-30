<?php

namespace Tests\Feature;

use App\Models\DvaSrcaQuestion;
use App\Models\GuessWordWord;
use App\Models\ImpostorWord;
use App\Models\RatherQuestion;
use App\Models\TruthDareQuestion;
use App\Support\StarterFreeContent;
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
            'impostor_words' => 240,
            'impostor_subcategories' => 3,
            'truth_dare_categories' => 20,
            'truth_dare_questions' => 240,
            'truth_dare_subcategories' => 3,
            'rather_categories' => 20,
            'rather_questions' => 240,
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
            $this->assertSame(1, DB::table("{$game}_categories")->where('is_free', true)->count());
        }

        $this->assertSame(120, DB::table('truth_dare_questions')->where('type', 'truth')->count());
        $this->assertSame(120, DB::table('truth_dare_questions')->where('type', 'dare')->count());
        $this->assertCategoryItemCount('impostor', 'words', 'priroda', 50);
        $this->assertCategoryItemCount('truth_dare', 'questions', 'smijesne-situacije', 50);
        $this->assertCategoryItemCount('rather', 'questions', 'svemir', 50);
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
        $this->assertCount(240, $hints);
        foreach ($hints as $hint) {
            $this->assertCount(2, preg_split('/\s+/u', trim($hint)));
        }

        $this->assertDatabaseHas('impostor_words', ['word' => 'Lubenica', 'hint' => 'Ljetno voće']);
    }

    public function test_monthly_free_expansion_contains_forty_unique_items_per_active_game(): void
    {
        $impostorWords = array_column(StarterFreeContent::IMPOSTOR_WORDS, 0);
        $truthDareQuestions = array_column(StarterFreeContent::TRUTH_DARE, 1);
        $ratherPairs = array_map(
            fn (array $pair) => mb_strtolower($pair[0].'|'.$pair[1]),
            StarterFreeContent::RATHER_QUESTIONS,
        );

        $this->assertCount(40, $impostorWords);
        $this->assertCount(40, array_unique(array_map('mb_strtolower', $impostorWords)));
        $this->assertCount(40, $truthDareQuestions);
        $this->assertCount(40, array_unique(array_map('mb_strtolower', $truthDareQuestions)));
        $this->assertCount(40, $ratherPairs);
        $this->assertCount(40, array_unique($ratherPairs));
        $this->assertCount(20, array_filter(StarterFreeContent::TRUTH_DARE, fn (array $item) => $item[0] === 'truth'));
        $this->assertCount(20, array_filter(StarterFreeContent::TRUTH_DARE, fn (array $item) => $item[0] === 'dare'));

        foreach (StarterFreeContent::IMPOSTOR_WORDS as [$word, $hint]) {
            $this->assertCount(2, preg_split('/\s+/u', trim($hint)), "Hint za {$word} mora imati dvije riječi.");
        }
    }

    private function assertCategoryItemCount(string $game, string $resource, string $slug, int $count): void
    {
        $categoryId = DB::table("{$game}_categories")->where('slug', $slug)->value('id');

        $this->assertNotNull($categoryId);
        $this->assertSame(
            $count,
            DB::table("{$game}_{$resource}")->where("{$game}_category_id", $categoryId)->count(),
        );
        $this->assertTrue((bool) DB::table("{$game}_categories")->where('id', $categoryId)->value('is_free'));
    }
}
