<?php

namespace App\Filament\Resources\Lots\Tables;

use App\Filament\Resources\Funds\RelationManagers\LotsRelationManager;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Component;

class LotsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at'),
                TextColumn::make('updated_at'),
                TextColumn::make('fund.name')
                    ->label('Fond')
                    ->sortable()
                    ->toggleable()
                    ->hidden(function (Component $livewire) {
                        return $livewire instanceof LotsRelationManager;
                    }),
                TextColumn::make('ref')
                    ->label('Cote')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('name')
                    ->label('Nom')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('date')
                    ->date()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('articles_count')
                    ->label("Objets")
                    ->counts('articles')
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
