<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    public function funds(): HasMany
    {
        return $this->hasMany(Fund::class);
    }

    public function lots(): HasMany
    {
        return $this->hasMany(Lot::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
