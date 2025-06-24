<?php

namespace App\Filament\Resources\Keywords\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KeywordForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('fr'),
                TextInput::make('de'),
                TextInput::make('en'),
            ]);
    }
}
