<?php

namespace App\Filament\Resources\Locations\Pages;

use App\Filament\Resources\Locations\LocationResource;
use App\Filament\Resources\Locations\RelationManagers\ArticlesRelationManager;
use App\Filament\Resources\Locations\RelationManagers\FundsRelationManager;
use App\Filament\Resources\Locations\RelationManagers\LotsRelationManager;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLocation extends ViewRecord
{
    protected static string $resource = LocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function getRelationManagers(): array
    {
        return [
            ArticlesRelationManager::class,
            LotsRelationManager::class,
            FundsRelationManager::class,
        ];
    }
}
