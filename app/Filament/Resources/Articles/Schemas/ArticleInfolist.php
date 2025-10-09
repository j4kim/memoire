<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Article;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ArticleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')->label("ID"),
                TextEntry::make('description'),
                TextEntry::make('subtitle')
                    ->label("Titre alternatif"),
                TextEntry::make('fund.ref_and_name')
                    ->label("Fond")
                    ->state(false)
                    ->prefixActions([
                        Action::make('link')
                            ->label(fn(Article $article) => $article->fund->ref_and_name)
                            ->url(fn(Article $article) => $article->fundUrl())
                            ->link()
                            ->visible(fn(Article $article) => $article->fund)
                    ]),
                TextEntry::make('lot.ref_and_name')
                    ->label("Lot")
                    ->state(false)
                    ->prefixActions([
                        Action::make('link')
                            ->label(fn(Article $article) => $article->lot->ref_and_name)
                            ->url(fn(Article $article) => $article->lotUrl())
                            ->link()
                            ->visible(fn(Article $article) => $article->lot)
                    ]),
                TextEntry::make('location.name')
                    ->label("Localisation"),
                TextEntry::make('category.name')
                    ->label("Catégorie"),
                TextEntry::make('date')
                    ->label("Date")
                    ->state(function (Article $record) {
                        if ($record->date) return $record->date->isoFormat("LL");
                        return "~$record->year_from-$record->year_to";
                    }),
                TextEntry::make('collation')
                    ->numeric(),
                TextEntry::make('state')
                    ->label('État')
                    ->numeric(),
                TextEntry::make('language')
                    ->label("Langues"),
                TextEntry::make('created_at')
                    ->label("Entré le")
                    ->isoDate('LLL'),
                TextEntry::make('updated_at')
                    ->label("Modifié le")
                    ->isoDate('LLL'),
            ]);
    }
}
