<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => response()->file(public_path('dist/index.html')))
    ->withoutMiddleware([
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
    ]);

Route::get('/{legal}', fn () => response()->file(public_path('dist/index.html')))
    ->whereIn('legal', ['privacy', 'terms', 'cookies'])
    ->withoutMiddleware([
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
    ]);
