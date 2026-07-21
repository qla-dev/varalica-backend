<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GuessWordCategory extends Model
{
    protected $guarded = [];

    protected $casts = ['is_free' => 'boolean'];

    public function words(): HasMany
    {
        return $this->hasMany(GuessWordWord::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(GuessWordSubcategory::class, 'guess_word_subcategory_id');
    }
}
