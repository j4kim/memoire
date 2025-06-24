<?php

namespace App\Filament\Resources\Funds\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FundInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('location.name')
                    ->numeric(),
                TextEntry::make('name'),
                TextEntry::make('ref'),
                TextEntry::make('status'),
                TextEntry::make('creation_date')
                    ->date(),
                TextEntry::make('year_from')
                    ->numeric(),
                TextEntry::make('year_to')
                    ->numeric(),
            ]);
    }
}
