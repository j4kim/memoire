<?php

namespace App\Filament\Resources\Keywords\Tables;

use App\Filament\Helpers;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KeywordsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ...Helpers::systemColumns(),
                TextColumn::make('fr')->searchable()->sortable(),
                TextColumn::make('de')->searchable()->sortable(),
                TextColumn::make('en')->searchable()->sortable(),
                TextColumn::make('articles_count')
                    ->label("Objets")
                    ->counts('articles')
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
