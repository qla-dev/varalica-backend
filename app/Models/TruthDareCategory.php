<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TruthDareCategory extends Model
{
    protected $guarded = [];

    public function questions(): HasMany
    {
        return $this->hasMany(TruthDareQuestion::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(TruthDareSubcategory::class, 'truth_dare_subcategory_id');
    }
}
