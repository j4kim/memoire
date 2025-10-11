<?php

namespace App\Filament\Resources\People\Tables;

use App\Filament\Helpers;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PeopleTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ...Helpers::systemColumns(),
                TextColumn::make('first_name')->searchable()->sortable(),
                TextColumn::make('last_name')->searchable()->sortable(),
                TextColumn::make('birth_year')->numeric()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('death_year')->numeric()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('address')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('postal_code')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('locality')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('country')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('phone')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('email')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('position')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('articles_count')
                    ->label("Objets")
                    ->counts('articles')
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
            ->recordActions([])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
