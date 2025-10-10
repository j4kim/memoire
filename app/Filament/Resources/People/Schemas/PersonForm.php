<?php

namespace App\Filament\Resources\People\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PersonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('first_name'),
                TextInput::make('last_name'),
                TextInput::make('birth_year')->numeric(),
                TextInput::make('death_year')->numeric(),
                Textarea::make('description'),
                TextInput::make('address'),
                TextInput::make('postal_code'),
                TextInput::make('locality'),
                TextInput::make('country'),
                TextInput::make('phone')->tel(),
                TextInput::make('email')->email(),
                TextInput::make('position'),
            ]);
    }
}
