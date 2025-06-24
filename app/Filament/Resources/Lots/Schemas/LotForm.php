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
                    ->relationship('fund', 'name'),
                Select::make('location_id')
                    ->relationship('location', 'name'),
                TextInput::make('name')
                    ->required(),
                TextInput::make('ref')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('status'),
                DatePicker::make('date'),
                TextInput::make('price')
                    ->numeric()
                    ->prefix('$'),
            ]);
    }
}
