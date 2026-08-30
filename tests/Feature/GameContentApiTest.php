<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameContentApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_each_game_exposes_categories_and_content(): void
    {
        $routes = [
            'impostor' => ['words', 280],
            'truth-dare' => ['questions', 240],
            'rather' => ['questions', 240],
            'dva-srca' => ['questions', 200],
            'guess-word' => ['words', 200],
        ];

        foreach ($routes as $game => [$resource, $itemCount]) {
            $this->getJson("/api/{$game}/categories")
                ->assertOk()
                ->assertJsonCount(20, 'data')
                ->assertJsonPath('data.0.subcategory.id', fn ($id) => is_int($id))
                ->assertJsonPath('data.0.subtitle', fn ($subtitle) => is_string($subtitle) && $subtitle !== '')
                ->assertJsonPath('data.0.color', fn ($color) => is_string($color) && str_starts_with($color, '#'))
                ->assertJsonPath('data.0.emoji', fn ($emoji) => is_string($emoji) && $emoji !== '');

            $this->getJson("/api/{$game}/subcategories")
                ->assertOk()
                ->assertJsonCount(3, 'data');

            $this->getJson("/api/{$game}/{$resource}")
                ->assertOk()
                ->assertJsonCount($itemCount, 'data')
                ->assertJsonPath('data.0.category.slug', fn ($slug) => is_string($slug) && $slug !== '')
                ->assertJsonPath('data.0.category.subcategory.id', fn ($id) => is_int($id));
        }
    }

    public function test_content_can_be_filtered_by_category_and_type(): void
    {
        $this->getJson('/api/impostor/words?category=priroda')
            ->assertOk()
            ->assertJsonCount(50, 'data');

        $this->getJson('/api/impostor/words?category=skola')
            ->assertOk()
            ->assertJsonCount(50, 'data');

        $this->getJson('/api/truth-dare/questions?type=truth')
            ->assertOk()
            ->assertJsonCount(120, 'data');

        $subcategoryId = $this->getJson('/api/impostor/subcategories')->json('data.0.id');
        $this->getJson("/api/impostor/words?subcategory_id={$subcategoryId}")
            ->assertOk()
            ->assertJsonCount(110, 'data');
    }
}
