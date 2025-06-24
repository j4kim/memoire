<?php

namespace App\Filament\Resources\Lots\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LotInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('fund.name')
                    ->numeric(),
                TextEntry::make('location.name')
                    ->numeric(),
                TextEntry::make('name'),
                TextEntry::make('ref'),
                TextEntry::make('status'),
                TextEntry::make('date')
                    ->date(),
                TextEntry::make('price')
                    ->money(),
            ]);
    }
}
