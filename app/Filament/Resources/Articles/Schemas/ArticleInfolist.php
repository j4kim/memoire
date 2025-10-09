<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Article;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ArticleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                    TextEntry::make('description')->columnSpan(2),
                    TextEntry::make('subtitle')->label("Titre alternatif")->columnSpan(2),
                    TextEntry::make('location.name')->label("Localisation"),
                    TextEntry::make('category.name')->label("Catégorie"),
                    TextEntry::make('date_or_year')->label("Date"),
                    TextEntry::make('collation')->numeric(),
                    TextEntry::make('state')->label('État')->numeric(),
                    TextEntry::make('language')->label("Langues"),
                ])->columns(4)->collapsible()->persistCollapsed(),


                Section::make('Système')->schema([
                    TextEntry::make('id')->label("ID"),
                    TextEntry::make('created_at')->label("Entré le")->isoDate('LLL'),
                    TextEntry::make('updated_at')->label("Modifié le")->isoDate('LLL'),
                ])->columns(4)->collapsible()->persistCollapsed(),
            ])->columns(1);
    }
}
