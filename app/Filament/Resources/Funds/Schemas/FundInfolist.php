<?php

namespace App\Filament\Resources\Funds\Schemas;

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
                    TextEntry::make('ref')->label('Cote')->columnSpan(2),
                    TextEntry::make('name')->columnSpan(2),

                    TextEntry::make('description')->columnSpan(4),

                    TextEntry::make('location.name')
                        ->label('Lieu')
                        ->numeric(),
                    TextEntry::make('creation_date')
                        ->label("Date de création")
                        ->isoDate('LL'),
                    TextEntry::make('year_from')
                        ->label("Années")
                        ->formatStateUsing(fn(Fund $record) => "de $record->year_from à $record->year_to"),
                ])->columns(4),

                Section::make('Système')->schema([
                    TextEntry::make('id')->label("ID"),
                    TextEntry::make('created_at'),
                    TextEntry::make('updated_at'),
                ])->columns(4)->collapsible()->persistCollapsed(),
            ])->columns(1);
    }
}
