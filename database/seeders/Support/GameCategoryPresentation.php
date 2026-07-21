<?php

namespace Database\Seeders\Support;

final class GameCategoryPresentation
{
    private const COLORS = [
        '#ef4444', '#f97316', '#f59e0b', '#84cc16', '#22c55e',
        '#14b8a6', '#06b6d4', '#3b82f6', '#6366f1', '#8b5cf6',
        '#a855f7', '#d946ef', '#ec4899', '#f43f5e', '#0ea5e9',
        '#10b981', '#eab308', '#fb7185', '#7c3aed', '#0891b2',
    ];

    private const EMOJIS = [
        'Životinje' => '🐾', 'Hrana' => '🍉', 'Škola' => '🎒', 'Sportovi' => '⚽',
        'Sport' => '⚽', 'Priroda' => '🌿', 'Prevoz' => '🚗', 'Zanimanja' => '🧑‍🚒',
        'Bajke' => '🏰', 'Kuća' => '🏠', 'Muzika' => '🎵', 'Svemir' => '🚀',
        'Tehnologija' => '🤖', 'Odjeća' => '👕', 'Igračke' => '🧸', 'Vrijeme' => '🌦️',
        'Grad' => '🏙️', 'More' => '🌊', 'Farma' => '🚜', 'Praznici' => '🎉',
        'Putovanja' => '🧳', 'Prijateljstvo' => '🤝', 'Porodica' => '👨‍👩‍👧',
        'Upoznavanje' => '👋', 'Lijepe uspomene' => '📸', 'Omiljene stvari' => '⭐',
        'Hobiji' => '🎨', 'Filmovi i crtići' => '🎬', 'Filmovi i priče' => '📖',
        'Mašta' => '💭', 'Superheroji' => '🦸', 'Supermoći' => '⚡',
        'Smiješne situacije' => '😂', 'Dobre navike' => '🌱', 'Timski duh' => '🙌',
        'Talenti' => '🌟', 'Budućnost' => '🔮', 'Avanture' => '🗺️',
        'Snove i želje' => '✨', 'Smijeh' => '😄', 'Timski rad' => '🤝',
        'Dobre osobine' => '💛', 'Zahvalnost' => '🙏', 'Podrška' => '🫶',
        'Zima' => '❄️', 'Ljeto' => '☀️',
    ];

    public static function for(string $name, int $index): array
    {
        return [
            'color' => self::COLORS[$index % count(self::COLORS)],
            'emoji' => self::EMOJIS[$name] ?? '🎲',
        ];
    }
}
