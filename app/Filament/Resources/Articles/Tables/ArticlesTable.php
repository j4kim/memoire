<?php

namespace App\Filament\Resources\Articles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('fund.name')
                    ->label('Fond')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('lot.name')
                    ->label('Lot')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('ref')
                    ->label('Cote')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('title')
                    ->label('Titre')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Catégorie')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('date')
                    ->date()
                    ->sortable()
                    ->sortable(),
                TextColumn::make('collation')
                    ->numeric()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('state')
                    ->label('État')
                    ->numeric()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('language')
                    ->label('Langue')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
