<?php

namespace App\Filament\Resources\Lots\Pages;

use App\Filament\Resources\Lots\LotResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewLot extends ViewRecord
{
    protected static string $resource = LotResource::class;

    public function getTitle(): string | Htmlable
    {
        return $this->record->name;
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
