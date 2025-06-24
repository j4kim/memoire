<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ArticleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('fund.name')
                    ->numeric(),
                TextEntry::make('lot.name')
                    ->numeric(),
                TextEntry::make('location.name')
                    ->numeric(),
                TextEntry::make('keyword_id')
                    ->numeric(),
                TextEntry::make('category.name')
                    ->numeric(),
                TextEntry::make('title'),
                TextEntry::make('ref'),
                TextEntry::make('status'),
                TextEntry::make('year')
                    ->numeric(),
                TextEntry::make('subtitle'),
                TextEntry::make('year_from')
                    ->numeric(),
                TextEntry::make('year_to')
                    ->numeric(),
                TextEntry::make('collation')
                    ->numeric(),
                TextEntry::make('state')
                    ->numeric(),
                TextEntry::make('language')
                    ->numeric(),
            ]);
    }
}
