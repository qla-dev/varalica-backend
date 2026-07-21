<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DvaSrcaCategory extends Model
{
    protected $guarded = [];

    protected $casts = ['is_free' => 'boolean'];

    public function questions(): HasMany
    {
        return $this->hasMany(DvaSrcaQuestion::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(DvaSrcaSubcategory::class, 'dva_srca_subcategory_id');
    }
}
