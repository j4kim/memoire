<?php

namespace App\Filament\Resources\Articles\Schemas;

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
                Select::make('fund_id')
                    ->relationship('fund', 'name'),
                Select::make('lot_id')
                    ->relationship('lot', 'name'),
                Select::make('location_id')
                    ->relationship('location', 'name'),
                TextInput::make('keyword_id')
                    ->numeric(),
                Select::make('category_id')
                    ->relationship('category', 'name'),
                TextInput::make('title')
                    ->required(),
                TextInput::make('ref')
                    ->required(),
                TextInput::make('status'),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('year')
                    ->numeric(),
                TextInput::make('dimensions'),
                TextInput::make('techniques'),
                Textarea::make('inscriptions')
                    ->columnSpanFull(),
                TextInput::make('geography'),
                Textarea::make('storage_cond')
                    ->columnSpanFull(),
                TextInput::make('subtitle'),
                TextInput::make('year_from')
                    ->numeric(),
                TextInput::make('year_to')
                    ->numeric(),
                TextInput::make('collation')
                    ->numeric(),
                TextInput::make('state')
                    ->numeric(),
                TextInput::make('language')
                    ->numeric(),
            ]);
    }
}
