<?php

namespace App\Filament\Resources\Lots\Schemas;

use App\Models\Fund;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LotForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Logistique')
                    ->schema([
                        Select::make('fund_id')
                            ->label("Fond")
                            ->relationship('fund')
                            ->searchable(['name', 'ref'])
                            ->preload()
                            ->getOptionLabelFromRecordUsing(fn(Fund $fund) => $fund->ref_and_name),
                    ])
                    ->columns(2),

                Section::make('Classification')
                    ->schema([
                        TextInput::make('ref')
                            ->label('Cote')
                            ->required(),
                        TextInput::make('name')
                            ->label('Nom')
                            ->required(),
                        Textarea::make('description'),
                        Select::make('location_id')
                            ->label("Lieu")
                            ->relationship('location', 'name')
                            ->searchable(['name'])
                            ->preload(),
                        DatePicker::make('date'),
                        TextInput::make('price')
                            ->label('Prix')
                            ->numeric()
                            ->prefix('CHF'),
                    ])
                    ->columns(2),
            ])->columns(1);
    }
}
