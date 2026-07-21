<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DvaSrcaSubcategory extends Model
{
    protected $guarded = [];

    public function categories(): HasMany
    {
        return $this->hasMany(DvaSrcaCategory::class, 'dva_srca_subcategory_id');
    }
}
