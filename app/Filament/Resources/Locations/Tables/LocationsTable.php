<?php

namespace App\Filament\Resources\Locations\Tables;

use App\Filament\Helpers;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LocationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ...Helpers::systemColumns(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('articles_count')
                    ->label("Objets")
                    ->counts('articles')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('lots_count')
                    ->label("Lots")
                    ->counts('lots')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('funds_count')
                    ->label("Fonds")
                    ->counts('funds')
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
