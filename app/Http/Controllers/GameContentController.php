<?php

namespace App\Http\Controllers;

use App\Models\DvaSrcaCategory;
use App\Models\DvaSrcaQuestion;
use App\Models\DvaSrcaSubcategory;
use App\Models\GuessWordCategory;
use App\Models\GuessWordSubcategory;
use App\Models\GuessWordWord;
use App\Models\ImpostorCategory;
use App\Models\ImpostorSubcategory;
use App\Models\ImpostorWord;
use App\Models\RatherCategory;
use App\Models\RatherQuestion;
use App\Models\RatherSubcategory;
use App\Models\TruthDareCategory;
use App\Models\TruthDareQuestion;
use App\Models\TruthDareSubcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameContentController extends Controller
{
    private const GAMES = [
        'impostor' => [
            'category' => ImpostorCategory::class,
            'item' => ImpostorWord::class,
            'subcategory' => ImpostorSubcategory::class,
            'resource' => 'words',
            'relation' => 'words',
            'foreign_key' => 'impostor_category_id',
            'group_foreign_key' => 'impostor_subcategory_id',
        ],
        'truth-dare' => [
            'category' => TruthDareCategory::class,
            'item' => TruthDareQuestion::class,
            'subcategory' => TruthDareSubcategory::class,
            'resource' => 'questions',
            'relation' => 'questions',
            'foreign_key' => 'truth_dare_category_id',
            'group_foreign_key' => 'truth_dare_subcategory_id',
        ],
        'rather' => [
            'category' => RatherCategory::class,
            'item' => RatherQuestion::class,
            'subcategory' => RatherSubcategory::class,
            'resource' => 'questions',
            'relation' => 'questions',
            'foreign_key' => 'rather_category_id',
            'group_foreign_key' => 'rather_subcategory_id',
        ],
        'dva-srca' => [
            'category' => DvaSrcaCategory::class,
            'item' => DvaSrcaQuestion::class,
            'subcategory' => DvaSrcaSubcategory::class,
            'resource' => 'questions',
            'relation' => 'questions',
            'foreign_key' => 'dva_srca_category_id',
            'group_foreign_key' => 'dva_srca_subcategory_id',
        ],
        'guess-word' => [
            'category' => GuessWordCategory::class,
            'item' => GuessWordWord::class,
            'subcategory' => GuessWordSubcategory::class,
            'resource' => 'words',
            'relation' => 'words',
            'foreign_key' => 'guess_word_category_id',
            'group_foreign_key' => 'guess_word_subcategory_id',
        ],
    ];

    public function categories(string $game): JsonResponse
    {
        $config = $this->game($game);
        $categories = $config['category']::query()
            ->with('subcategory')
            ->withCount($config['relation'])
            ->orderBy('id')
            ->get();

        return response()->json(['data' => $categories]);
    }

    public function category(string $game, string $category): JsonResponse
    {
        $config = $this->game($game);
        $record = $this->findCategory($config['category'], $category)
            ->load(['subcategory', $config['relation']]);

        return response()->json(['data' => $record]);
    }

    public function items(Request $request, string $game, string $resource): JsonResponse
    {
        $config = $this->game($game, $resource);
        $query = $config['item']::query()->with('category.subcategory');

        if ($request->filled('category_id')) {
            $query->where($config['foreign_key'], $request->integer('category_id'));
        }

        if ($request->filled('category')) {
            $category = $this->findCategory($config['category'], (string) $request->query('category'));
            $query->where($config['foreign_key'], $category->getKey());
        }

        if ($request->filled('subcategory_id')) {
            $query->whereHas('category', fn ($categoryQuery) => $categoryQuery
                ->where($config['group_foreign_key'], $request->integer('subcategory_id')));
        }

        if ($game === 'truth-dare' && in_array($request->query('type'), ['truth', 'dare'], true)) {
            $query->where('type', $request->query('type'));
        }

        $limit = min(500, max(1, $request->integer('limit', 500)));
        $items = $query->orderBy('id')->limit($limit)->get();

        return response()->json(['data' => $items]);
    }

    public function item(string $game, string $resource, int $item): JsonResponse
    {
        $config = $this->game($game, $resource);
        $record = $config['item']::query()->with('category.subcategory')->findOrFail($item);

        return response()->json(['data' => $record]);
    }

    public function subcategories(string $game): JsonResponse
    {
        $config = $this->game($game);
        $records = $config['subcategory']::query()
            ->with(['categories' => fn ($query) => $query
                ->withCount($config['relation'])
                ->orderBy('id')])
            ->withCount('categories')
            ->orderBy('id')
            ->get();

        return response()->json(['data' => $records]);
    }

    public function subcategory(string $game, int $subcategory): JsonResponse
    {
        $config = $this->game($game);
        $record = $config['subcategory']::query()
            ->with(['categories' => fn ($query) => $query
                ->with($config['relation'])
                ->orderBy('id')])
            ->findOrFail($subcategory);

        return response()->json(['data' => $record]);
    }

    /** @return array<string, class-string<Model>|string> */
    private function game(string $game, ?string $resource = null): array
    {
        abort_unless(isset(self::GAMES[$game]), 404);
        $config = self::GAMES[$game];
        abort_if($resource !== null && $resource !== $config['resource'], 404);

        return $config;
    }

    /** @param class-string<Model> $model */
    private function findCategory(string $model, string $idOrSlug): Model
    {
        return $model::query()
            ->where('id', ctype_digit($idOrSlug) ? (int) $idOrSlug : 0)
            ->orWhere('slug', $idOrSlug)
            ->firstOrFail();
    }
}
