<?php

namespace App\Models;

use App\Filament\Resources\Funds\FundResource;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lot extends Model
{
    public function fund(): BelongsTo
    {
        return $this->belongsTo(Fund::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    protected function refAndName(): Attribute
    {
        return Attribute::make(
            get: fn() => "$this->ref - $this->name",
        );
    }

    public function fundUrl(): ?string
    {
        if (!$this->fund) {
            return null;
        }
        return FundResource::getUrl('view', ['record' => $this->fund]);
    }
}
