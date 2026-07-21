<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RatherSubcategory extends Model
{
    protected $guarded = [];

    public function categories(): HasMany
    {
        return $this->hasMany(RatherCategory::class, 'rather_subcategory_id');
    }
}
