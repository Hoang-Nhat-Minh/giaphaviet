<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Branch;

class Lineage extends Model
{
    /**
     * ***
     */
    public function branch(): HasMany
    {
        return $this->hasMany(Branch::class, 'lineage_id','id');
    }

    protected $guarded = [];
}
