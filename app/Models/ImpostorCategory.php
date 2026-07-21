<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ImpostorCategory extends Model
{
    protected $guarded = [];

    protected $casts = ['is_free' => 'boolean'];

    public function words(): HasMany
    {
        return $this->hasMany(ImpostorWord::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(ImpostorSubcategory::class, 'impostor_subcategory_id');
    }
}
