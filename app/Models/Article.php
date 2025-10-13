<?php

namespace App\Models;

use App\Filament\Resources\Lots\LotResource;
use App\Models\Traits\BelongsToFund;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

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
        return $this->belongsToMany(Person::class)->withPivot('role');
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
        return $this->belongsToMany(Attachment::class)->withPivot('illustrates');
    }

    public function illustrations(): BelongsToMany
    {
        return $this->attachments()->wherePivot('illustrates', true);
    }

    public function getIllustration(): ?Attachment
    {
        return $this->illustrations->first();
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

    public function attach(TemporaryUploadedFile $file, ?string $description)
    {
        $path = $file->store();
        $attachment = Attachment::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'description' => $description,
            'metadata' => [
                'original_name' => $file->getClientOriginalName(),
                'dimensions' => $file->dimensions(),
                'size' => $file->getSize(),
                'original_extension' => $file->getClientOriginalExtension(),
            ],
        ]);
        $illustrates = false;
        if ($this->illustrations()->doesntExist() && $attachment->isImage()) {
            $illustrates = true;
        }
        $this->attachments()->attach($attachment, ['illustrates' => $illustrates]);
    }

    public static function getNextRefFromBase(string $base): string
    {
        $greater = Article::where('ref', 'like', "$base/%")
            ->selectRaw(
                "substring_index(ref, '/', -1) as tail"
            )->orderByRaw(
                "convert(substring_index(ref, '/', -1), unsigned) desc"
            )
            ->first();
        $nextTail = $greater?->tail + 1;
        return "$base/$nextTail";
    }

    public function getNextRef(): string
    {
        $base = str($this->ref)->beforeLast('/');
        return Article::getNextRefFromBase($base);
    }
}
