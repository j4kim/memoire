<?php

namespace App\Filament\Resources\People\Schemas;

use App\Filament\Helpers;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PersonInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Coordonnées')->schema([
                    TextEntry::make('first_name')->label("Prénom"),
                    TextEntry::make('last_name')->label("Nom"),
                    TextEntry::make('birth_year')->label("Naissance")->numeric(),
                    TextEntry::make('death_year')->label("Décès")->numeric(),
                    TextEntry::make('description')->columnSpan(2),
                    TextEntry::make('address')->label("Adresse")->columnSpan(2),
                    TextEntry::make('postal_code')->label("Code postal"),
                    TextEntry::make('locality')->label("Localité"),
                    TextEntry::make('country')->label("Pays"),
                    TextEntry::make('phone')->label("Téléphone"),
                    TextEntry::make('email'),
                    TextEntry::make('position'),
                ])->columns(4),

                Helpers::systemSection(),
            ])->columns(1);
    }
}
