<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TruthDareSubcategory extends Model
{
    protected $guarded = [];

    public function categories(): HasMany
    {
        return $this->hasMany(TruthDareCategory::class, 'truth_dare_subcategory_id');
    }
}
