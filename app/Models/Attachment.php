<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

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
        return $this->belongsToMany(Article::class)->withPivot('illustrates');
    }

    public function isImage(): bool
    {
        return str_starts_with($this->mime_type, "image/");
    }

    public function url(): string
    {
        return Storage::temporaryUrl($this->path, now()->addMinutes(30));
    }
}
