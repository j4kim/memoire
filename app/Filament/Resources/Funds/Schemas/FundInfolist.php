<?php

namespace App\Filament\Resources\Funds\Schemas;

use App\Models\Fund;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FundInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('description'),
                TextEntry::make('location.name')
                    ->label('Localisation')
                    ->numeric(),
                TextEntry::make('creation_date')
                    ->label("Date de création")
                    ->isoDate('LL'),
                TextEntry::make('year_from')
                    ->label("Années")
                    ->formatStateUsing(fn (Fund $record) => "de $record->year_from à $record->year_to"),
                TextEntry::make('created_at')
                    ->label("Entré le")
                    ->isoDate('LLL'),
                TextEntry::make('updated_at')
                    ->label("Modifié le")
                    ->isoDate('LLL'),
            ]);
    }
}
