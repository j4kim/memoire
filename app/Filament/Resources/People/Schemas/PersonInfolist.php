<?php

namespace App\Filament\Resources\People\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PersonInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('first_name'),
                TextEntry::make('last_name'),
                TextEntry::make('birth_year')
                    ->numeric(),
                TextEntry::make('death_year')
                    ->numeric(),
                TextEntry::make('address'),
                TextEntry::make('postal_code'),
                TextEntry::make('locality'),
                TextEntry::make('country'),
                TextEntry::make('phone'),
                TextEntry::make('email'),
                TextEntry::make('position'),
            ]);
    }
}
