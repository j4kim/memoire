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
                TextColumn::make('first_name')->label("Prénom")->searchable(),
                TextColumn::make('last_name')->label("Nom")->searchable(),
                TextColumn::make('birth_year')->label("Naissance")->numeric()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('death_year')->label("Décès")->numeric()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('address')->label("Adresse")->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('postal_code')->label("Code postal")->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('locality')->label("Localité")->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('country')->label("Pays")->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('phone')->label("Téléphone")->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('email')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('position')->toggleable(isToggledHiddenByDefault: true),
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
