<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Person extends Model
{
    public function funds(): BelongsToMany
    {
        return $this->belongsToMany(Fund::class);
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn() => "$this->first_name $this->last_name"
        );
    }
}
