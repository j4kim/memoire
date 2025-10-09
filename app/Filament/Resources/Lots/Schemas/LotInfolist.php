<?php

namespace App\Filament\Resources\Lots\Schemas;

use App\Filament\Resources\Funds\FundResource;
use App\Models\Lot;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LotInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('description'),
                TextEntry::make('fund.ref_and_name')
                    ->label("Fond")
                    ->url(fn(Lot $lot): string => FundResource::getUrl('view', ['record' => $lot->fund])),
                TextEntry::make('location.name')
                    ->label("Localisation"),
                TextEntry::make('date')
                    ->isoDate("LL"),
                TextEntry::make('price')
                    ->label('Prix')
                    ->money('CHF'),
                TextEntry::make('created_at')
                    ->label("Entré le")
                    ->isoDate('LLL'),
                TextEntry::make('updated_at')
                    ->label("Modifié le")
                    ->isoDate('LLL'),
            ]);
    }
}
