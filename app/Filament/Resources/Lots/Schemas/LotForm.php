<?php

namespace App\Filament\Resources\Lots\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LotForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('fund_id')
                    ->label("Fond")
                    ->relationship('fund', 'name'),
                Select::make('location_id')
                    ->label("Localisation")
                    ->relationship('location', 'name'),
                TextInput::make('name')
                    ->label('Nom')
                    ->required(),
                TextInput::make('ref')
                    ->label('Cote')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                DatePicker::make('date'),
                TextInput::make('price')
                    ->label('Prix')
                    ->numeric()
                    ->prefix('CHF'),
            ]);
    }
}
