<?php

namespace App\Models;

use App\Models\Traits\BelongsToLocation;
use App\Models\Traits\HasRefAndName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fund extends Model
{
    use BelongsToLocation, HasRefAndName;

    public function lots(): HasMany
    {
        return $this->hasMany(Lot::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class)->withPivot('role');
    }
}
