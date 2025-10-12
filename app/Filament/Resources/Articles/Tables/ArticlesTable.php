<?php

namespace App\Filament\Resources\Articles\Tables;

use App\Filament\Helpers;
use App\Filament\Resources\Lots\RelationManagers\ArticlesRelationManager;
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
                ImageColumn::make('illustrations.thumbnail_path')
                    ->label("")
                    ->square(),
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
                    ->wrap()
                    ->extraCellAttributes(['style' => 'min-width:14rem'])
                    ->sortable()
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Catégorie')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('keywords.fr')
                    ->wrap()
                    ->label("Mots-matière")
                    ->badge()
                    ->limitList(2)
                    ->toggleable(),
                TextColumn::make('locations.name')
                    ->label("Lieux")
                    ->limitList(1)
                    ->toggleable(),
                TextColumn::make('date_or_year')
                    ->label("Date")
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('collation')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('state')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('language')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('people_count')
                    ->label("Personnes")
                    ->counts('people')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('attachments_count')
                    ->label("Médias")
                    ->counts('attachments')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
