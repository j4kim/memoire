<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fund extends Model
{
    public function lots(): HasMany
    {
        return $this->hasMany(Lot::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    protected function refAndName(): Attribute
    {
        return Attribute::make(
            get: fn() => "$this->ref - $this->name",
        );
    }
}
