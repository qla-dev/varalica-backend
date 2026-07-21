<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RatherCategory extends Model
{
    protected $guarded = [];

    protected $casts = ['is_free' => 'boolean'];

    public function questions(): HasMany
    {
        return $this->hasMany(RatherQuestion::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(RatherSubcategory::class, 'rather_subcategory_id');
    }
}
