<?php

namespace App\Filament\Resources\Funds\RelationManagers;

use App\Filament\Resources\Lots\LotResource;
use Filament\Actions\AssociateAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class LotsRelationManager extends RelationManager
{
    protected static string $relationship = 'lots';
    protected static ?string $title = 'Lots dans ce fond';

    protected static ?string $relatedResource = LotResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                AssociateAction::make(),
                CreateAction::make(),
            ])
            ->recordActions([
                DissociateAction::make(),
                ViewAction::make(),
            ]);
    }
}
