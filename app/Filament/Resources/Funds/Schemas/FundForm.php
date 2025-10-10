<?php

namespace App\Filament\Resources\Funds\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FundForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Classification')->schema([
                    TextInput::make('ref')->label("Cote")->required(),
                    TextInput::make('name')->label('Nom')->required(),

                    Textarea::make('description')->columnSpan(2),

                    Select::make('location_id')
                        ->label('Localisation')
                        ->relationship('location', 'name')
                        ->searchable(['name'])
                        ->preload(),

                    DatePicker::make('creation_date')
                        ->label("Date de création"),

                    TextInput::make('year_from')
                        ->label("Années, de")
                        ->numeric(),
                    TextInput::make('year_to')
                        ->label("Années, à")
                        ->numeric(),
                ])->columns(2),

            ])->columns(1);
    }
}
