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
                Select::make('location_id')
                    ->relationship('location', 'name'),
                TextInput::make('name')
                    ->required(),
                TextInput::make('ref')
                    ->required(),
                TextInput::make('status'),
                Textarea::make('description')
                    ->columnSpanFull(),
                DatePicker::make('creation_date'),
                TextInput::make('year_from')
                    ->numeric(),
                TextInput::make('year_to')
                    ->numeric(),
            ]);
    }
}
