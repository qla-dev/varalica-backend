<?php

use Illuminate\Support\Facades\Route;

Route::redirect(
    '/apple-download',
    'https://apps.apple.com/app/varalica-imposter-igrica/id6784401796?l=hr'
)->withoutMiddleware([
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
]);

Route::get('/', fn () => response()->file(public_path('dist/index.html')))
    ->withoutMiddleware([
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
    ]);

Route::get('/download', fn () => response()->file(public_path('dist/index.html')))
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
