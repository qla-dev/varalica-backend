<?php

use App\Http\Controllers\GameContentController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', fn () => ['data' => ['status' => 'ok']]);

Route::get('/{game}/categories', [GameContentController::class, 'categories']);
Route::get('/{game}/categories/{category}', [GameContentController::class, 'category']);
Route::get('/{game}/subcategories', [GameContentController::class, 'subcategories']);
Route::get('/{game}/subcategories/{subcategory}', [GameContentController::class, 'subcategory']);
Route::get('/{game}/{resource}', [GameContentController::class, 'items']);
Route::get('/{game}/{resource}/{item}', [GameContentController::class, 'item']);
