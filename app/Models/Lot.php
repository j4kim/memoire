<?php

namespace App\Models;

use App\Models\Traits\BelongsToFund;
use App\Models\Traits\HasRefAndName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lot extends Model
{
    use BelongsToFund, HasRefAndName;

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
