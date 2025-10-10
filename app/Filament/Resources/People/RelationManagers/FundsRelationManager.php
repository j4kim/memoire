<?php

namespace App\Filament\Resources\People\RelationManagers;

use App\Filament\Helpers;
use App\Filament\Resources\Funds\FundResource;
use App\Models\Article;
use App\Models\Fund;
use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FundsRelationManager extends RelationManager
{
    protected static string $relationship = 'funds';
    protected static ?string $title = 'Fonds liés à cette personne';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                ...Helpers::systemColumns(),
                TextColumn::make('ref')->searchable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('role')->label("Rôle"),
            ])
            ->headerActions([
                AttachAction::make()->schema(fn(AttachAction $action): array => [
                    $action->getRecordSelect(),
                    Helpers::roleSelect(),
                ]),
            ])
            ->recordActions([
                DetachAction::make(),
                EditAction::make()->schema([
                    Helpers::roleSelect(),
                ])->modalWidth(Width::Large),
                ViewAction::make()->url(function (Fund $fund) {
                    return FundResource::getUrl('view', ['record' => $fund]);
                }),
            ]);
    }
}
