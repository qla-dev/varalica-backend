<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GuessWordSubcategory extends Model
{
    protected $guarded = [];

    public function categories(): HasMany
    {
        return $this->hasMany(GuessWordCategory::class, 'guess_word_subcategory_id');
    }
}
