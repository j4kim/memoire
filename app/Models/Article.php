<?php

namespace App\Models;

use App\Filament\Resources\Lots\LotResource;
use App\Models\Traits\BelongsToFund;
use App\Models\Traits\BelongsToLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use BelongsToFund, BelongsToLocation;

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'dimensions' => 'array',
            'techniques' => 'array',
            'geography' => 'array',
            'legacy' => 'array',
        ];
    }

    public function lot(): BelongsTo
    {
        return $this->belongsTo(Lot::class);
    }

    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    public function keywords(): BelongsToMany
    {
        return $this->belongsToMany(Keyword::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function attachments(): BelongsToMany
    {
        return $this->belongsToMany(Attachment::class);
    }

    public function lotUrl(): ?string
    {
        if (!$this->lot) {
            return null;
        }
        return LotResource::getUrl('view', ['record' => $this->lot]);
    }
}
