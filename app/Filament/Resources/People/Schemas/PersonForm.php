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
                TextInput::make('first_name')->label("Prénom"),
                TextInput::make('last_name')->label("Nom"),
                TextInput::make('birth_year')->label("Naissance")->numeric(),
                TextInput::make('death_year')->label("Décès")->numeric(),
                Textarea::make('description'),
                TextInput::make('address')->label("Adresse"),
                TextInput::make('postal_code')->label("Code postal"),
                TextInput::make('locality')->label("Localité"),
                TextInput::make('country')->label("Pays"),
                TextInput::make('phone')->tel()->label("Téléphone"),
                TextInput::make('email')->email(),
                TextInput::make('position'),
            ]);
    }
}
