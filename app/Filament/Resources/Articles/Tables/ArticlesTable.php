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
                    ->numeric()
                    ->sortable(),
                TextColumn::make('lot.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('location.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('keyword_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('ref')
                    ->searchable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('year')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('subtitle')
                    ->searchable(),
                TextColumn::make('year_from')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('year_to')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('collation')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('state')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('language')
                    ->numeric()
                    ->sortable(),
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
