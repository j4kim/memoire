<?php

namespace App\Filament\Resources\Keywords\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class KeywordInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('fr'),
                TextEntry::make('de'),
                TextEntry::make('en'),
            ]);
    }
}
