<?php

namespace App\Filament\Resources\Funds\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FundForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nom')
                    ->required(),
                TextInput::make('ref')
                    ->label("Cote")
                    ->required(),
                Select::make('location_id')
                    ->label('Localisation')
                    ->relationship('location', 'name')
                    ->searchable(['name'])
                    ->preload(),
                Textarea::make('description'),
                DatePicker::make('creation_date')
                    ->label("Date de création"),
                TextInput::make('year_from')
                    ->label("Années, de")
                    ->numeric(),
                TextInput::make('year_to')
                    ->label("Années, à")
                    ->numeric(),
            ]);
    }
}
