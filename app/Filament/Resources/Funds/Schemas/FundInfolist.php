<?php

namespace App\Filament\Resources\Funds\Schemas;

use App\Filament\Helpers;
use App\Filament\Resources\Locations\LocationResource;
use App\Models\Fund;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FundInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Classification')->schema([
                    TextEntry::make('ref'),
                    TextEntry::make('name'),

                    TextEntry::make('description'),

                    TextEntry::make('location')
                        ->label("Lieu")
                        ->url(fn($state) => LocationResource::getUrl('view', ['record' => $state]))
                        ->formatStateUsing(fn($state) => $state->name),

                    TextEntry::make('creation_date')
                        ->isoDate('LL'),
                    TextEntry::make('year_from')
                        ->label("Années")
                        ->formatStateUsing(fn(Fund $record) => "de $record->year_from à $record->year_to"),
                ])->columns(2),

                Helpers::systemSection(),
            ])->columns(1);
    }
}
