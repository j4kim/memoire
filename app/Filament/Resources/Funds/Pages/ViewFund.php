<?php

namespace App\Filament\Resources\Funds\Pages;

use App\Filament\Resources\Funds\FundResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewFund extends ViewRecord
{
    protected static string $resource = FundResource::class;

    public function getTitle(): string | Htmlable{
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
