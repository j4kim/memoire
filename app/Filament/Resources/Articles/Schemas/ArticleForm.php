<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Fund;
use App\Models\Lot;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label("Titre")
                    ->required(),
                TextInput::make('ref')
                    ->label("Cote")
                    ->required(),
                Textarea::make('description'),
                TextInput::make('subtitle')
                    ->label("Titre alternatif"),
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
                Select::make('location_id')
                    ->label("Localisation")
                    ->relationship('location', 'name')
                    ->searchable(['name'])
                    ->preload(),
                Select::make('category_id')
                    ->label("Catégorie")
                    ->relationship('category', 'name')
                    ->searchable(['name'])
                    ->preload(),
                DatePicker::make('date')
                    ->label("Date (précise)"),
                TextInput::make('year_from')
                    ->label("Année (approx) de")
                    ->numeric(),
                TextInput::make('year_to')
                    ->label("Année (approx) à")
                    ->numeric(),
                Textarea::make('dimensions'),
                Textarea::make('techniques'),
                Textarea::make('inscriptions'),
                Textarea::make('geography')
                    ->label("Géographie"),
                Textarea::make('storage_cond')
                    ->label("Condition de stockage"),
                TextInput::make('collation')
                    ->numeric(),
                TextInput::make('state')
                    ->label("État")
                    ->numeric(),
                TextInput::make('language')
                    ->label("Langues")
                    ->numeric(),
            ]);
    }
}
