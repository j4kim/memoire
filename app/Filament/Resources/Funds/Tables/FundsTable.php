<?php

namespace App\Filament\Resources\Funds\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FundsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('created_at'),
                TextColumn::make('updated_at'),
                TextColumn::make('ref'),
                TextColumn::make('name'),
                TextColumn::make('lots_count')
                    ->label("Lots")
                    ->counts('lots')
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
