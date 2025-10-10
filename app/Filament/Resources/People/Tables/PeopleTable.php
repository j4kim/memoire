<?php

namespace App\Filament\Resources\People\Tables;

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
                TextColumn::make('id'),
                TextColumn::make('created_at'),
                TextColumn::make('updated_at'),
                TextColumn::make('first_name')->label("Prénom")->searchable(),
                TextColumn::make('last_name')->label("Nom")->searchable(),
                TextColumn::make('birth_year')->label("Naissance")->numeric()->sortable(),
                TextColumn::make('death_year')->label("Décès")->numeric()->sortable(),
                TextColumn::make('address')->label("Adresse"),
                TextColumn::make('postal_code')->label("Code postal"),
                TextColumn::make('locality')->label("Localité"),
                TextColumn::make('country')->label("Pays"),
                TextColumn::make('phone')->label("Téléphone"),
                TextColumn::make('email')->searchable(),
                TextColumn::make('position'),
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
