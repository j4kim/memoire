<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Fund;
use App\Models\Lot;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Logistique')
                    ->description("L'objet peut être attaché à un fond ou un lot. Évitez de renseigner les deux.")
                    ->schema([
                        Select::make('fund_id')
                            ->label("Fond")
                            ->relationship('fund')
                            ->searchable(['name', 'ref'])
                            ->preload()
                            ->getOptionLabelFromRecordUsing(fn(Fund $fund) => $fund->ref_and_name),
                        Select::make('lot_id')
                            ->label("Lot")
                            ->relationship('lot')
                            ->searchable(['name', 'ref'])
                            ->preload()
                            ->getOptionLabelFromRecordUsing(fn(Lot $lot) => $lot->ref_and_name),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->persistCollapsed(),

                Section::make('Classification')
                    ->schema([
                        TextInput::make('ref')->label("Cote")->required(),
                        TextInput::make('title')->label("Titre")->required(),
                        Textarea::make('description'),
                        TextInput::make('subtitle')->label("Titre alternatif"),

                        Select::make('locations')
                            ->label("Lieux")
                            ->relationship('locations', 'name')
                            ->multiple()
                            ->searchable(['name'])
                            ->preload(),
                        Select::make('category_id')
                            ->label("Catégorie")
                            ->relationship('category', 'name')
                            ->searchable(['name'])
                            ->preload(),

                        Section::make("Dates")
                            ->description("Vous pouvez renseigner une date précises ou deux années approximatives")
                            ->schema([
                                DatePicker::make('date')
                                    ->label("Date (précise)"),
                                null,
                                TextInput::make('year_from')
                                    ->label("Année (approx) de")
                                    ->numeric(),
                                TextInput::make('year_to')
                                    ->label("Année (approx) à")
                                    ->numeric(),
                            ])->columnSpan(2)->columns(2)->compact(),

                        TextInput::make('collation'),
                        TextInput::make('state')->label("État"),
                        TextInput::make('language')->label("Langues"),

                        Select::make('keywords')
                            ->label("Mots-smatière")
                            ->relationship('keywords', 'fr')
                            ->multiple()
                            ->searchable(['fr', 'de', 'en'])
                            ->preload(),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->persistCollapsed(),

                Section::make("Description de l'objet")
                    ->schema([
                        Textarea::make('dimensions'),
                        Textarea::make('techniques'),
                        Textarea::make('inscriptions'),
                        Textarea::make('geography')->label("Géographie"),
                        Textarea::make('storage_cond')->label("Condition de stockage"),
                    ])
                    ->collapsed(),
            ])->columns(1);
    }
}
