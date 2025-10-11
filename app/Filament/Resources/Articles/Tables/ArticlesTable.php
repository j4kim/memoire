<?php

namespace App\Filament\Resources\Articles\Tables;

use App\Filament\Helpers;
use App\Filament\Resources\Lots\RelationManagers\ArticlesRelationManager;
use App\Models\Article;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Component;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('illustrations.path')
                    ->label("")
                    ->square()
                    ->url(fn(Article $record) => $record->getIllustration()?->url())
                    ->openUrlInNewTab()
                    ->state(fn(Article $record) => $record->getIllustration()?->path),
                ...Helpers::systemColumns(),
                TextColumn::make('fund.name')
                    ->label('Fond')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->hidden(function (Component $livewire) {
                        return $livewire instanceof ArticlesRelationManager;
                    }),
                TextColumn::make('lot.name')
                    ->label('Lot')
                    ->sortable()
                    ->toggleable()
                    ->hidden(function (Component $livewire) {
                        return $livewire instanceof ArticlesRelationManager;
                    }),
                Helpers::refColumn(),
                TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Catégorie')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('date_or_year')
                    ->label("Date"),
                TextColumn::make('collation')
                    ->numeric()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('state')
                    ->numeric()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('language')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
