<?php

namespace App\Models;

use App\Filament\Resources\Lots\LotResource;
use App\Models\Traits\BelongsToFund;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use BelongsToFund;

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'dimensions' => 'array',
            'techniques' => 'array',
            'geography' => 'array',
            'legacy' => 'object',
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

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class);
    }

    public function lotUrl(): ?string
    {
        if (!$this->lot) {
            return null;
        }
        return LotResource::getUrl('view', ['record' => $this->lot]);
    }

    protected function dateOrYear(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->date) return $this->date->isoFormat("LL");
                $years = collect([$this->year_from, $this->year_to])->filter()->unique();
                if ($years->isEmpty()) {
                    return null;
                }
                if ($years->containsOneItem()) {
                    return "~" . $years->first();
                }
                return "~" . $years->join("-");
            }
        );
    }
}
