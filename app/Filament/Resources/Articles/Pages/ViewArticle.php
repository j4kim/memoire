<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewArticle extends ViewRecord
{
    protected static string $resource = ArticleResource::class;

    public function getTitle(): string | Htmlable
    {
        return $this->record->title;
    }

    public function getSubheading(): ?string
    {
        return $this->record->ref;
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
