<?php

namespace App\Filament\Resources\Lots\Schemas;

use App\Filament\Helpers;
use App\Filament\Resources\Locations\LocationResource;
use App\Models\Lot;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LotInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Logistique')->schema([
                    TextEntry::make('fund')
                        ->label("Fond")
                        ->url(fn($state, Lot $lot) => $lot->fundUrl())
                        ->formatStateUsing(fn($state) =>  $state->ref_and_name),
                ])->columns(2)->collapsible()->persistCollapsed(),

                Section::make('Classification')->schema([
                    TextEntry::make('ref'),
                    TextEntry::make('name'),

                    TextEntry::make('description'),

                    TextEntry::make('location')
                        ->label("Lieu")
                        ->url(fn($state) => LocationResource::getUrl('view', ['record' => $state]))
                        ->formatStateUsing(fn($state) => $state->name),

                    TextEntry::make('date')
                        ->isoDate("LL"),
                    TextEntry::make('price')
                        ->money('CHF'),
                ])->columns(2),

                Helpers::systemSection(),
            ])->columns(1);
    }
}
