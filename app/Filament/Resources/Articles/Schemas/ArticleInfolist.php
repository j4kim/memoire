<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Filament\Helpers;
use App\Filament\Resources\Categories\CategoryResource;
use App\Filament\Resources\Keywords\KeywordResource;
use App\Models\Article;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\View;
use Filament\Schemas\Schema;

class ArticleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                View::make('filament.article-illustration'),

                Section::make('Logistique')->schema([
                    TextEntry::make('fund')
                        ->label("Fond")
                        ->url(fn($state, Article $article) => $article->fundUrl())
                        ->formatStateUsing(fn($state) =>  $state->ref_and_name),

                    TextEntry::make('lot')
                        ->label("Lot")
                        ->url(fn($state, Article $article) => $article->lotUrl())
                        ->formatStateUsing(fn($state) =>  $state->ref_and_name),
                ])->columns(2)->collapsible()->persistCollapsed(),

                Section::make('Classification')->schema([
                    TextEntry::make('ref')->columnSpan(2),
                    TextEntry::make('title')->columnSpan(2),
                    TextEntry::make('description')->columnSpan(2),
                    TextEntry::make('subtitle')->columnSpan(2),
                    TextEntry::make('locations.name')->label("Lieux"),
                    TextEntry::make('category')
                        ->label("Catégorie")
                        ->url(fn($state) => CategoryResource::getUrl('view', ['record' => $state]))
                        ->formatStateUsing(fn($state) => $state->name),
                    TextEntry::make('date_or_year')->label("Date"),
                    TextEntry::make('collation')->numeric(),
                    TextEntry::make('state')->numeric(),
                    TextEntry::make('language'),
                    TextEntry::make('keywords')
                        ->label("Mots-matière")
                        ->badge()
                        ->url(fn($state) => KeywordResource::getUrl('view', ['record' => $state]))
                        ->formatStateUsing(fn($state) => $state->fr),
                ])->columns(4)->collapsible()->persistCollapsed(),

                Helpers::systemSection(),
            ])->columns(1);
    }
}
