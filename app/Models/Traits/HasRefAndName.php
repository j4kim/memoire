<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasRefAndName
{
    protected function refAndName(): Attribute
    {
        return Attribute::make(
            get: fn() => "$this->ref - $this->name",
        );
    }
}
