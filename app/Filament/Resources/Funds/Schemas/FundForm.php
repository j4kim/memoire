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
                    TextInput::make('ref')->required(),
                    TextInput::make('name')->required(),

                    Textarea::make('description'),

                    Select::make('location_id')
                        ->label('Lieu')
                        ->relationship('location', 'name')
                        ->searchable(['name'])
                        ->preload(),

                    DatePicker::make('creation_date'),

                    Section::make('Années')->compact()->schema([
                        TextInput::make('year_from')->label("De")->numeric(),
                        TextInput::make('year_to')->label("À")->numeric(),
                    ])->columns(2),
                ])->columns(2),

            ])->columns(1);
    }
}
