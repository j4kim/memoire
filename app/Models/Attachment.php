<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attachment extends Model
{

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
        ];
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }

    public function isImage(): bool
    {
        return str_starts_with($this->mime_type, "image/");
    }
}
