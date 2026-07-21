<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ImpostorSubcategory extends Model
{
    protected $guarded = [];

    public function categories(): HasMany
    {
        return $this->hasMany(ImpostorCategory::class, 'impostor_subcategory_id');
    }
}
