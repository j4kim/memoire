<?php

namespace App\Filament\Resources\Lots\Tables;

use App\Filament\Helpers;
use App\Filament\Resources\Funds\RelationManagers\LotsRelationManager;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Component;

class LotsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ...Helpers::systemColumns(),
                TextColumn::make('fund.name')
                    ->label('Fond')
                    ->sortable()
                    ->toggleable()
                    ->hidden(function (Component $livewire) {
                        return $livewire instanceof LotsRelationManager;
                    }),
                Helpers::refColumn(),
                TextColumn::make('name'),
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
