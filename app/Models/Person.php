<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Person extends Model
{
    public function funds(): BelongsToMany
    {
        return $this->belongsToMany(Fund::class)->withPivot('role');
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class)->withPivot('role');
    }
}
