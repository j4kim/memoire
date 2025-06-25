<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
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

    public function fund(): BelongsTo
    {
        return $this->belongsTo(Fund::class);
    }

    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
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
}
