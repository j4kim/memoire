<?php

namespace App\Filament\Resources\Lots\Schemas;

use App\Models\Lot;
use Filament\Actions\Action;
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
                    ->state(false)
                    ->prefixActions([
                        Action::make('link')
                            ->label(fn(Lot $lot) => $lot->fund->ref_and_name)
                            ->url(fn(Lot $lot) => $lot->fundUrl())
                            ->link()
                            ->visible(fn(Lot $lot) => $lot->fund)
                    ]),
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
