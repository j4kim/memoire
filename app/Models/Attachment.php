<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class Attachment extends Model
{
    protected static function booted()
    {
        static::creating(function (Attachment $attachment) {
            try {
                $attachment->createThumbnail();
            } catch (\Exception $e) {
                Log::error("Error creating thumbnail for attachment $attachment->id", ['message' => $e->getMessage()]);
            }
        });
    }

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

    public function thumbnailUrl(): string
    {
        return Storage::temporaryUrl($this->thumbnail_path, now()->addMinutes(30));
    }

    public function createThumbnail()
    {
        if (!$this->isImage()) {
            return;
        }
        $img = Image::read(Storage::get($this->path));
        $img->scaleDown(height: 222);
        $this->thumbnail_path = "thumbnails/$this->path";
        Storage::put($this->thumbnail_path, $img->encode());
    }
}
