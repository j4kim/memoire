<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Filament\Helpers;
use App\Filament\Resources\Keywords\KeywordResource;
use App\Models\Article;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Image;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ArticleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Image::make(
                    url: fn(Article $article) => $article->getIllustration()?->url(),
                    alt: "Image d'illustration"
                )
                    ->visible(fn(Article $article) => $article->getIllustration()?->url())
                    ->imageHeight('14rem')
                    ->alignCenter(),

                Section::make('Logistique')->schema([
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
                ])->columns(2)->collapsible()->persistCollapsed(),

                Section::make('Classification')->schema([
                    TextEntry::make('ref')->columnSpan(2),
                    TextEntry::make('title')->columnSpan(2),
                    TextEntry::make('description')->columnSpan(2),
                    TextEntry::make('subtitle')->columnSpan(2),
                    TextEntry::make('locations.name')->label("Lieux"),
                    TextEntry::make('category.name')->label("Catégorie"),
                    TextEntry::make('date_or_year')->label("Date"),
                    TextEntry::make('collation')->numeric(),
                    TextEntry::make('state')->numeric(),
                    TextEntry::make('language'),
                    TextEntry::make('keywords')
                        ->label("Mots-matière")
                        ->badge()
                        ->url(function ($state) {
                            return KeywordResource::getUrl('view', ['record' => $state]);
                        })
                        ->formatStateUsing(function ($state) {
                            return $state->fr;
                        }),
                ])->columns(4)->collapsible()->persistCollapsed(),

                Helpers::systemSection(),
            ])->columns(1);
    }
}
